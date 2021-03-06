(: section:'head+'
  <link rel="stylesheet" href="vendor/dinamictable/jquery.dinamictable.css">
(: endSection

(: section:'template-options'
  <script id="template-options" type="text/x-tmpl">
    (:
      $opts = [];
      if($allows['detail'])  $opts[] = '<a href="./admin/'.$menu.'/{%=o.id%}/detail">Ver</a>';
      if($allows['edit'])    $opts[] = '<a href="./admin/'.$menu.'/{%=o.id%}/edit">Editar</a>';
      if($allows['delete'])  $opts[] = '<a href="./admin/'.$menu.'/{%=o.id%}/delete">Eliminar</a>';
    :)
    <small>
      (:= implode('&nbsp;|&nbsp;', $opts)
    </small>
  </script>
(: endSection

(: section:'foot+'
  <script src="vendor/tmpl.min.js"></script>
  <script src="vendor/dinamictable/jquery.dinamictable.js"></script>
  (: put:'template-options'
  <script>
    $(function(){
      
      $('#dinamic-table').dinamictable({
        fnRecord: function(data, rowNumber, row){
          var result = [];
          
          for(var i in data)
            result.push(data[i]);
          
          if($('#template-options').length>0)
            result.push(tmpl('template-options', data));

          return result;
        }
      });
      
    });
  </script>
(: endSection

(: section:'searchBar'
  <div>
    <input id="table-search" type="text" class="form-control" placeholder="Buscar">
  </div>
(: endSection

(: section:'dinamicTable'
  (: $showOptions = (isset($allows['detail']) && $allows['detail']) ||
                    (isset($allows['edit'])   && $allows['edit']) ||
                    (isset($allows['delete']) && $allows['delete']) :)

  <table
    class="table records-list"
    id="dinamic-table"
    data-param-len="15"
    data-param-data-url="admin/(:= $menu :)/data"
    data-param-input-search-selector="#table-search"
    data-param-pagination-selector="#table-pagination"
    data-param-count-record="#dinamic-table-count-record"
    data-param-field-row-state-class="cls"
  >
    <thead>
      <tr>
        (: foreach ($forms['list'] as $field => $def):
          <th data-param-show="(:= (!isset($def['show']) || $def['show']==true)? 'true' : 'false' :)">
            (: if(!isset($def['show']) || $def['show']==true):
              <span>(:= itemOr('label', $def, $field) :)</span>
            (: endif
            (: if(!isset($def['sort']) || $def['sort']==true):
              <span class="btn-xs" data-param-sort-asc>
                <span class="glyphicon glyphicon-chevron-down"></span>
              </span>
              <span class="btn-xs" data-param-sort-desc>
                <span class="glyphicon glyphicon-chevron-up"></span>
              </span>
            (: endif
          </th>
        (: endforeach
        (: if($showOptions):
          <th data-param-sort="false" data-param-class="text-center">
            <div>Opciones</div>
          </th>
        (: endif
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="(:= count($forms['list'])+($showOptions? 1:0) :)">
          <p id="dinamic-table-count-record" class="text-muted pull-left table-count-record">
            <i>
              <small dinamic-table-msg="showing">Mostrando registros del {$rf} - {$rt} de {$fc} encontrados de un total {$co} en la tabla</small>
              <small dinamic-table-msg="no-records-filtered">No se encontraron registros de un total {$co} en la tabla</small>
              <small dinamic-table-msg="no-records">No se existen registros en la tabla</small>
            </i>
          </p>
          <div class="pull-right">
            <ul id="table-pagination" class="pagination pagination-sm" data-param-pagination-items="2">
              <li><a data-param-page="first" href="#">&larr;</a></li>
              <li><a data-param-page="prev"  href="#">&laquo;</a></li>
              <li><a data-param-page="next"  href="#">&raquo;</a></li>
              <li><a data-param-page="last"  href="#">&rarr;</a></li>
            </ul>
          </div>
        </td>
      </tr>
    </tfoot>
  </table>
(: endSection