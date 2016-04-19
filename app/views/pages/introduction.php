(:: parent:views/docs.php :)
(:: set:pageTitle='Introducción' :)
(:: set:subMenuItem='introduction' :)

<div>
  <h2 id="terms">Términos</h2>
  <p>
    A continuación se definen alguno de los términos utilizados en la documentación:
  </p>
  <div class="table-responsive">
    <table class="table striped">
      <thead>
        <tr>
          <th class="s3">Término</th>
          <th>Descripción</th>
        </tr>
      </thead>
      <tbody class="text-left">
        <tr>
          <th>Aplicación</th>
          <td>
            Unidad de software conformada por subrutinas, clases, vistas, recursos y configuraciones entre otros, dispuestos de tal forma que dan solución a un problema.
          </td>
        </tr>
        <tr>
          <th>Extensión</th>
          <td>
            Módulos de software que pueden ser incluidos mediante Amathista para agregar una funcionalidad.
          </td>
        </tr>
        <tr>
          <th>Modo <i>routing</i></th>
          <td>
            Ejecución de Amathista desde un servidor web para atender peticiones HTTP.
          </td>
        </tr>
        <tr>
          <th>Modo <i>tasking</i></th>
          <td>
            Ejecución de Amathista desde la línea de comandos para ejecutar una tarea o interpretar comandos.
          </td>
        </tr>
        <tr>
          <th>Archivo de configuración</th>
          <td>
            Archivo de extensión <code><strong>.conf.php</strong></code> que retorna un hash con una determinada configuración.
          </td>
        </tr>
        <tr>
          <th>Archivo de configuración raíz</th>
          <td>
            Archivo de configuración <code><strong>am.conf.php</strong></code> que contiene la configuración básica de una aplicación o extensión. Está ubicado en la carpeta raíz del mismo.
          </td>
        </tr>
        <tr>
          <th>Archivo de configuración principal</th>
          <td>
            Archivo de configuración raíz de la aplicación.
          </td>
        </tr>
        <tr>
          <th>Archivo de inicio</th>
          <td>
            Archivo <code><strong>am.init.php</strong></code> contiene el código de inicialización de una aplicación o extensión. Está ubicado en el directorio raíz del mismo.
          </td>
        </tr>
        <tr>
          <th>Archivo de inicio principal</th>
          <td>
            Archivo de inicio de la aplicación.
          </td>
        </tr>
        <tr>
          <th>Bootfile</th>
          <td>
            Archivo de arranque de Amathista. Se encarga de incluir el núcleo de Amathista, inicializar la aplicación y ejecutarla. Por lo general es el archivo /public/index.php. Es el único archivo que se ejecuta fuera del Entorno de ejecución.
          </td>
        </tr>
        <tr>
          <th>Directorio raíz de la aplicación</th>
          <td>
            Directorio contenedor de código fuente de la applicación como lo son los controladores, vistas y modelos entre otros) y donde se ejecutará Amathista (no confundir con el Directorio público). Este es definido en el llamado del método <code><strong>Am::app()</strong></code> del <code><strong>bootfile</strong></code>, en el cual por defecto es el directorio <code><strong>/app/</strong></code>. Su estructura interna es definida a conveniencia.
          </td>
        </tr>
        <tr>
          <th>Directorio público de la aplicación</th>
          <td>
            Directorio de archivos públicos de la aplicación. Contiene el archivo de arranque y los recursos públicos como los son archivos javascript, hoja de estilos, imágenes y fuentes entre otros. Su estructura interna es definida a conveniencia.
          </td>
        </tr>
        <tr>
          <th>Directorio de Amathista</th>
          <td>
            Directorio del cual se incluye Amathista y contiene su código fuente.
          </td>
        </tr>
        <tr>
          <th>Callback</th>
          <td>
            Puede ser una función, el nombre de una función, un método estático en formato de string (<code><strong>'Clase::metodo'</strong></code>) o formato array (<code><strong>array('Clase', 'metodo')</strong></code>) o un método de un objeto (<code><strong>array($obj, 'método')</strong></code>).
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div>
  <h2 id="requirements">Requerimientos</h2>

  <p>Para ejecutar Amathista solo se require PHP <strong>>=5.3</strong></p>
</div>

<div>
  <h2 id="download">Descarga</h2>

  <p>
    La descarga de Amathista se realiza desde GitHub ya sea como un archivo comprimido, o clonando el repositorio.
  </p>
  <ul>
    <li>
      <p>
        Descarga directa de <a class="link" target="_blank" href="https://codeload.github.com/SirIdeas/amathista/zip/master">GitHub</a>, y se descomprime donde resulte conveniente.
      </p>
    </li>
    <li>
      <p>
        Clonar desde GitHub en la carpeta que crea conveniente:
      </p>
      <pre><code class="language-bash">$ git clone https://github.com/SirIdeas/amathista.git</code></pre>
    </li>
  </ul>
</div>

<div>
  <h2 id="struct">Estructura</h2>

  <p>
    La estructura básica de una aplicación en Amathista consiste de 3 carpetas principales:
  </p>
  <div class="table-responsive">
    <table class="table striped">
      <thead>
        <tr>
          <th class="s2">Directorio</th>
          <th>Uso</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code><strong>/am/</strong></code></td>
          <td>Directorio de Amathista.</td>
        </tr>
        <tr>
          <td><code><strong>/app/</strong></code></td>
          <td>Directorio raíz de la aplicación.</td>
        </tr>
        <tr>
          <td><code><strong>/public/</strong></code></td>
          <td>Directorio público de la aplicación</td>
        </tr>
      </tbody>
    </table>
  </div>
  <p>
    Estas carpetas pueden tener el nombre que convenga e inclusive pueden estar ubicadas en lugares que se desee.
  </p>
  <p>
    Para efectos de la documentación estos directorios estarán ubicados al mismo nivel.
  </p>
</div>

<div>
  <h2 id="init-files">Archivos iniciales</h2>
  
  <p>
    La plantilla base de Amathista incluye otros archivos:
  </p>
  <div class="table-responsive">
    <table class="table striped">
      <thead>
        <tr>
          <th class="s3">Archivo</th>
          <th>Descripción</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code><strong>/app/am.conf.php</strong></code></td>
          <td>Archivo de configuración principal de la aplicación</td>
        </tr>
        <tr>
          <td><code><strong>/app/routing.conf.php</strong></code></td>
          <td>Archivo de rutas la aplicación.</td>
        </tr>
        <tr>
          <td><code><strong>/app/tpls/tpl.php</strong></code></td>
          <td>Plantilla inicial</td>
        </tr>
        <tr>
          <td><code><strong>/app/controllers/Index.class.php</strong></code></td>
          <td>Controlador inicial</td>
        </tr>
        <tr>
          <td><code><strong>/app/controllers/views/index.php</strong></code></td>
          <td>Vista index del controlador Index</td>
        </tr>
        <tr>
          <td><code><strong>/public/index.php</strong></code></td>
          <td>Bootfile.</td>
        </tr>
        <tr>
          <td><code><strong>/public/.htaccess</strong></code></td>
          <td>Configuración de Apache para la aplicación.</td>
        </tr>
        <tr>
          <td><code><strong>/public/serverblock.conf</strong></code></td>
          <td>Configuración de Nginx para la aplicación.</td>
        </tr>
        <tr>
          <td><code><strong>/public/404.html</strong></code></td>
          <td>Vista para errores 404.</td>
        </tr>
        <tr>
          <td><code><strong>/public/fixes/*</strong></code></td>
          <td>Varios fixes CSS y JS</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div>
  <h2 id="test-site">Sitio de pruebas</h2>

  <p>
    Para verificar que todo vaya bien se puede ejecutar el sitio desde un navegador. En nuestro caso creamos el proyecto dentro de la carpeta <code><strong>testsite</strong></code> dentro de la carpeta web de nuestra instalación local de WAMPP:
  </p>
  <img class="def-img" src="(:/:)/images/testfile-folder.jpg" alt="testfile-folder.jpg">

  <p>
    Ejecutamos el sitio en un navegador mediante la url <code><strong>http://localhost/testsite/public/</strong></code>:
  </p>
  <img class="def-img" src="(:/:)/images/testsite-first-look.jpg" alt="testsite-first-look.jpg">
</div>