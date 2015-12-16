<?php
/**
 * Amathista - PHP Framework
 *
 * @author Alex J. Rondón <arondn2@gmail.com>
 * 
 */

/**
 * -----------------------------------------------------------------------------
 * Clase para crear respuestas con callbacks
 * -----------------------------------------------------------------------------
 */
class AmCallResponse extends AmResponse{

  protected

    /**
     * -------------------------------------------------------------------------
     * String o array Callback a llamar.
     * -------------------------------------------------------------------------
     * Puede ser el nombre de una función, un método estático en formato de
     * string ('Clase::metodo') o formato array (array('Clase', 'metodo')) o un
     * método de un objeto (array($obj, 'método')).
     */
    $callback = null,

    /**
     * -------------------------------------------------------------------------
     * Callback obtenido apartir el $callback.
     * -------------------------------------------------------------------------
     * @var null
     */
    $realCallback = null,

    /**
     * -------------------------------------------------------------------------
     * Array con las variables de entorno.
     * -------------------------------------------------------------------------
     * Es agregado como ultimo argumento de la llamada.
     */
    $env = array(),

    /**
     * -------------------------------------------------------------------------
     * Array todos los parámetros de la llamada.
     * -------------------------------------------------------------------------
     * Contiene los parámetros obtenido de la ruta.
     */
    $params = array(),

    /**
     * -------------------------------------------------------------------------
     * Indica si el callback es válido.
     * -------------------------------------------------------------------------
     * @var boolean
     */
    $isValidCallback = false;

  /**
   * -------------------------------------------------------------------------
   * Asignar callback
   * --------------------------------------------------------------------------
   * @param  array/string   $callback   Callback a ser llamado
   * @return this
   */
  public function callback($callback){
    $this->callback = $callback;
    
    // Obtener el callback real
    $this->realCallback = $this->getCallback();

    return $this;
  }

  /**
   * -------------------------------------------------------------------------
   * Asignar variables de entorno
   * --------------------------------------------------------------------------
   * @param  array   $env   Variables de entorno
   * @return this
   */
  public function env(array $env){
    $this->env = $env;
    return $this;
  }

  /**
   * -------------------------------------------------------------------------
   * Asignar parámetros de la llamada
   * --------------------------------------------------------------------------
   * @param  array   $args   Parámetros de la llamada
   * @return this
   */
  public function params(array $params){
    $this->params = $params;
    return $this;
  }

  private function getCallback(){

    $c = $this->callback;

    // Responder como una función como controlador
    if (is_array($c) && call_user_func_array('method_exists', $c))
      
      return $c;

    if(function_exists($c))

      return $c;

    // Responder con un método estático como controlador
    if(preg_match('/^(.*)::(.*)$/', $c, $a)){
      array_shift($a);

      if(call_user_func_array('method_exists', $a))
        return $a;

    }

    return false;

  }

  /**
   * ---------------------------------------------------------------------------
   * Indica si la petición se puede resolver o no.
   * ---------------------------------------------------------------------------
   * Se sobreescribe el método para saber si el callback existe o no.
   * @return  boolean   Indica si la petición se puede resolver o no.
   */
  public function isResolved(){
    return parent::isResolved() && $this->realCallback !== false;
  }

  /**
   * ---------------------------------------------------------------------------
   * Acción de la respuesta: Realizar llamado del callback
   * ---------------------------------------------------------------------------
   * @return  AmResponse  Si el callback a ejecutar no existe se devuelve una
   *                      respuesta 404. De lo contario retorna null
   */
  public function make(){

    // Obtener las propiedades
    $params = $this->params;
    $env = $this->env;

    // Agegar entorno como último parámetro de la llamada.
    $params[] = $env;

    // Si $this->realCallback es un array entonces tiene un callback valido
    if($this->isResolved()){
      parent::make();

      return call_user_func_array($this->realCallback, $params);

    }

    // Responder con un error 404
    return Am::e404(Am::t('AMRESPONSE_CALLBACK_NOT_FOUND',
      var_export($this->callback, true)));

  }

}