<?php

interface ValidatorInterface
{
    public function passes($value);

    public function messages($field);
}

class RequiredValidator implements ValidatorInterface
{
    public function passes($value)
    {
        $value = trim($value);
        return strlen($value) > 0;
    }

    public function messages($field)
    {
        return strtoupper($field) . " Field is required !";
    }
}

class IntegerValidator implements ValidatorInterface
{
    public function passes($value)
    {
        $value = trim($value);
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    public function messages($field)
    {
        return " Enter integer !";
    }
}

class EmailValidator implements ValidatorInterface
{
    public function passes($value)
    {
        $value = trim($value);
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function messages($field)
    {
        return "It is not a valid email address!";
    }
}

class MinValidator implements ValidatorInterface
{
    public $params;
    public function __construct($params)
    {
        $this->params = $params;
    }

    public function passes($value)
    {

        return strlen($value) >= $this->params;
    }

    public function messages($field)
    {
        return " Minimum Uzunluq $this->params Olmalıdır !";
    }
}

class MaxValidator implements ValidatorInterface
{
    public $params;
    public function __construct($params)
    {
        $this->params = $params;
    }

    public function passes($value)
    {

        return strlen($value) <= $this->params;
        ;
    }

    public function messages($field)
    {
        return " Maksimum Uzunluq $this->params Olmalıdır !";
    }
}

class UniqueValidator implements ValidatorInterface
{
    public $params;
    public $dbConnection;
    public $table;
    public $column;
    public function __construct($params)
    {

        $params = explode(',', $params);

        [$this->table, $this->column] = $params;
        $this->dbConnection();
    }


    private function dbConnection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydatabase";

        try {
            $this->dbConnection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

    public function passes($value)
    {

        $sql = "SELECT $this->column FROM $this->table WHERE $this->column  = '$value'";
        $run = $this->dbConnection->prepare($sql);
        $run->execute();
        return !is_array($run->fetch(PDO::FETCH_ASSOC));
    }

    public function messages($field)
    {
        return " Deyer Movcuddur !";
    }
}

class ExistsValidator implements ValidatorInterface
{
    public $params;
    public $dbConnection;
    public $table;
    public $column;
    public function __construct($params)
    {

        $params = explode(',', $params);

        [$this->table, $this->column] = $params;
        $this->dbConnection();
    }


    private function dbConnection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydatabase";

        try {
            $this->dbConnection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

    public function passes($value)
    {

        $sql = "SELECT $this->column FROM $this->table WHERE $this->column  = '$value'";
        $run = $this->dbConnection->prepare($sql);
        $run->execute();
        return !is_array($run->fetch(PDO::FETCH_ASSOC));
    }

    public function messages($field)
    {
        return "Deyer Movcuddur !";
    }
}

class InValidator implements ValidatorInterface
{
    private $validValues;

    public function __construct($validValues)
    {
        $this->validValues = array_map('intval', explode(',', $validValues));
    }

    public function passes($value)
    {
        $value = trim($value);
        return in_array((int) $value, $this->validValues, true);
    }

    public function messages($field)
    {
        return strtoupper($field) . " must be one of the following values: " . implode(', ', $this->validValues) . ".";
    }
}

class Validator
{

    public static $errors = [];
    public static function make($data, $rules)
    {

        $validatorClasses = [
            'required' => RequiredValidator::class,
            'min' => MinValidator::class,
            'max' => MaxValidator::class,
            'unique' => UniqueValidator::class,
            'exists' => ExistsValidator::class,
            'integer' => IntegerValidator::class,
            'email' => EmailValidator::class,
            'in' => InValidator::class,
        ];
        foreach ($rules as $field => $validationRules) {
            foreach ($validationRules as $rule) {
                $ruleParametrs = explode(':', $rule);
                $ruleClassName = $ruleParametrs[0];

                if (count($ruleParametrs) > 1) {

                    if (in_array($ruleClassName, array_keys($validatorClasses))) {
                        $ruleClassOption = $ruleParametrs[1];
                        $instance = (new $validatorClasses[$ruleClassName]($ruleClassOption));
                    }
                } else {
                    if (in_array($ruleClassName, array_keys($validatorClasses))) {
                        $instance = (new $validatorClasses[$ruleClassName]);
                    }
                }
                $check = $instance->passes($data[$field]);

                if (!$check) {
                    if (!isset(self::$errors[$field])) {
                        self::$errors[$field][] = $instance->messages($field);
                        self::$errors[$field] = $instance->messages($field);
                    }
                }

            }

        }
    }


    public function fails()
    {
        return count(self::$errors) > 0 ? 1 : 0;
    }
    public function errors()
    {
        return self::$errors;
    }
}
