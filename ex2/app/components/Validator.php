<?php

require_once(__DIR__ . './../../bootstrap.php');

class Validator {
  private $data; // data to validate
  private $errors = []; // array of errors

  public function __construct(array $data) {
    $this->data = $data;
  }

  /**
   * validation with the specified rules.
   */
  public function validate(array $rules)
  {
    foreach ($rules as $field => $ruleSet) {
      $value = $this->data[$field] ?? null;
      $rulesArray = explode('|', $ruleSet);
      foreach ($rulesArray as $rule) {

        // Check if nullable is in the rules
        if (in_array('nullable', $rulesArray) && is_null($value)) {
          // If nullable and the value is null, skip all other rules
          continue;
        }
        $ruleName = $rule;
        $params = [];

        // manage rules with parameters, e.g. min:3
        if (strpos($rule, ':') !== false) {
          [$ruleName, $paramString] = explode(':', $rule);
          $params = explode(',', $paramString);
        }

        // call the validation method
        $method = "validate" . ucfirst($ruleName);
        if (method_exists($this, $method)) {
          $this->$method($field, $value, ...$params);
        } else {
          throw new Exception("Validaton rule $ruleName not supported.");
        }
      }
    }

    return empty($this->errors);
  }

  /**
   * Return validaiton errors.
   */
  public function errors() {
    return $this->errors;
  }

  /**
   * Add errors.
   */
  private function addError($field, $message) {
    $this->errors[$field][] = $message;
  }

  /**
   * Rule: mandatory field.
   */
  private function validateRequired($field, $value) {
    if (empty($value) && $value !== '0') {
      $this->addError($field, "The field $field is mandatory.");
    }
  }

  /**
   * Rule: string type.
   */
  private function validateString($field, $value) {
    if (!is_string($value)) {
      $this->addError($field, "The field $field must be a string.");
    }
  }

  /**
   * Rule: integer type.
   */
  private function validateInteger($field, $value) {
    if (!filter_var($value, FILTER_VALIDATE_INT)) {
      $this->addError($field, "The field $field must be an integer.");
    }
  }

  /**
   * Rule: array field.
   */
  private function validateArray($field, $value)
  {
    if (!is_array($value)) {
      $this->addError($field, "The field $field must be an array.");
    }
  }

  /**
   * Rule: image file.
   */
  private function validateImage($field, $value)
  {
    if (!is_file($value) || !@getimagesize($value)) {
      $this->addError($field, "The field $field must be a valid image.");
    }
  }

  /**
   * Rule: file MIME type.
   */
  // private function validateMimes($field, $value, ...$types) {
  //   $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
  //   $mimeType = finfo_file($fileInfo, $value);

  //   if (!in_array($mimeType, $types)) {
  //     $this->addError($field, "The field $field must be one of this MIME type: " . implode(', ', $types));
  //   }
  // }

  /**
   * Rule: min length.
   */
  private function validateMin($field, $value, $min)
  {
    if (strlen($value) < $min) {
      $this->addError($field, "The field $field must have a minimum of $min characters.");
    }
  }

  /**
   * Rule: max length.
   */
  private function validateMax($field, $value, $max)
  {
    if (strlen($value) > $max) {
      $this->addError($field, "The field $field can have max $max characters.");
    }
  }

  /**
   * Rule: numeric value.
   */
  private function validateNumeric($field, $value) {
    if (!is_numeric($value)) {
      $this->addError($field, "The field $field must be numeric.");
    }
  }

  /**
   * Rule: valore email.
   */
  private function validateEmail($field, $value)
  {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $this->addError($field, "The field $field must be a valid email.");
    }
  }

  /**
   * Rule: unique value in the DB.
   */
  private function validateUnique($field, $value, $table, $column) {
    $db = new Database();
    $stmt = $db->conn->prepare("SELECT COUNT(*) FROM $table WHERE $column = :value");
    $stmt->bindParam(':value', $value);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
      $this->addError($field, "The field $field must be unique.");
    }
  }

  private function validateNullable($field, $value) {
      // nothing to do
  }
}
