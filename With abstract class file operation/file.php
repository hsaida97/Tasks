<?php
abstract class FileUploader
{
    protected $targetDir;
    protected $fileName;
    protected $fileType;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function uploadFile($file)
    {
        $this->fileName = basename($file["name"]);
        $this->fileType = strtolower(pathinfo($this->targetDir . $this->fileName, PATHINFO_EXTENSION));

        if ($this->validateFileType() && move_uploaded_file($file["tmp_name"], $this->targetDir . $this->fileName)) {
            $this->processFile();
        } else {
            echo "Sorry, there was an error uploading your file or the file type is not allowed.";
        }
    }

    protected abstract function validateFileType();
    protected abstract function processFile();
}

class GradeFileUploader extends FileUploader
{
    private $grades;

    public function __construct($targetDir)
    {
        parent::__construct($targetDir);
        $this->grades = [];
    }

    protected function validateFileType()
    {
        return in_array($this->fileType, ["txt", "doc"]);
    }

    protected function processFile()
    {
        $fileContent = file($this->targetDir . $this->fileName);
        $results = fopen($this->targetDir . "results.txt", "w");

        foreach ($fileContent as $line) {
            $parts = preg_split('/\s+/', trim($line));
            if (count($parts) == 3) {
                [$name, $subject, $grade] = $parts;
                $grade = (int) $grade;
                $raisedGrade = $grade != 5 ? $grade + 1 : $grade;

                $this->grades[] = ['name' => $name, 'subject' => $subject, 'grade' => $raisedGrade];
                fwrite($results, "$name $subject $raisedGrade\n");
            }
        }
        fclose($results);
    }

    public function getGrades()
    {
        return $this->grades;
    }
}

