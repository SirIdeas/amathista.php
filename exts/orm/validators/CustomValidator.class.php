<?php

/**
 * Validacion por un método especifico del modelo
 */

class CustomValidator extends AmValidator{
  
  protected
      $fnName = null; // Nombre del metodo con el que se realizará la validacion

  protected function validate(AmModel &$model){
    $fnName = $this->getFnName();
    // Si no se asigna el nombre del validator
    // se tomara como metodo como prefijo "validator_$campoValidando"
    if(!$fnName)
      $fnName = "validator_{$this->fieldName()}";
    return $model->$fnName($this);
  }
  
  public function getFnName(){ return $this->fnName; }
  public function setFnName($value){ return $this->fnName = $value; }
  
}
