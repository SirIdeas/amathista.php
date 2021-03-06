<?php
/**
 * Amathista - PHP Framework
 *
 * @author Alex J. Rondón <arondn2@gmail.com>
 * 
 */

// PENDIENTE Documentar
class AmClauseFromItem extends AmClause{

  protected
    $table = null,
    $alias = null;

  public function __construct(array $data = array()){
    parent::__construct($data);

    $table = $this->table;

    if(empty($this->alias)){

      if($table instanceof AmQuery){
        $table = $table->getTable();
      }

      if($table instanceOf AmTable){
        $table = $table->getModel();
      }
      
      if(is_string($table)){
        $this->alias = str_replace('.', '_', $table);
      }

    }

    if(empty($this->alias)){
      throw Am::e('AMSCHEME_EMPTY_ALIAS', var_export($table, true));
    }

    $this->alias = $this->scheme->alias($this->alias, array_merge(
      $this->query->getFroms(),
      $this->query->getJoins()
    ));

  }

  public function getAlias(){

    return $this->alias;

  }

  public function getTable(){

    return $this->table;

  }

  public function addPossibleJoins(){

    $table = null;
    if($this->table instanceof AmTable){
      $table = $this->table;
    }elseif(is_string($this->table) && is_subclass_of($this->table, 'AmModel')){
      $model = $this->table;
      $table = $model::me();
    }

    $this->query->addPossibleJoins($table, $this->alias);

  }

  public function sql(){

    $table = $this->table;

    // Si es una consulta se incierra entre parentesis
    if($table instanceof AmQuery){
      $table = $this->scheme->_sqlSqlWrapper($table->sql());

    }elseif($table instanceOf AmTable){
      $tableName = $table->getTableName();
      $table = $this->scheme->nameWrapperAndRealScapeComplete($tableName);

    }elseif(is_string($table)){

      $tableName = $table;
      if(is_subclass_of($tableName, 'AmModel')){
        $tableName = $tableName::me()->getTableName();
      }
      $table = $this->scheme->nameWrapperAndRealScapeComplete($tableName);

    }else{
      throw Am::e('AMSCHEME_INVALID_FIELD', var_export($table, true));

    }

    $alias = $this->scheme->nameWrapperAndRealScape($this->alias);

    return $this->scheme->_sqlElementWithAlias($table, $alias);

  }

}