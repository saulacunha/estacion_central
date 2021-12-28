<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Contenido principal</h1>
    
    
    
 <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, node_id, alias, min_light_needed, water_needed, max_temperature, min_temperature FROM node";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaNodos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nodo id</th>
                                <th>Alias</th>
                                <th>% Min Luz</th>
                                <th>Agua necesaria 'lts'</th>
                                <th>Temperatura 'max'</th>
                                <th>Temperatura 'min'</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['node_id'] ?></td>
                                <td><?php echo $dat['alias'] ?></td>
                                <td><?php echo $dat['min_light_needed'] ?></td>
                                <td><?php echo $dat['water_needed'] ?></td>
                                <td><?php echo $dat['max_temperature'] ?></td>
                                <td><?php echo $dat['min_temperature'] ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formNodos">
            <div class="modal-body">
                <div class="form-group">
                <label for="node_id" class="col-form-label">Nodo:</label>
                <input type="text" class="form-control" id="node_id">
                </div>
                <div class="form-group">
                <label for="alias" class="col-form-label">Alias:</label>
                <input type="text" class="form-control" id="alias">
                </div>                
                <div class="form-group">
                <label for="min_light_needed" class="col-form-label">Luz:</label>
                <input type="number" class="form-control" id="min_light_needed">
                </div>
                <div class="form-group">
                <label for="water_needed" class="col-form-label">Agua:</label>
                <input type="number" class="form-control" id="water_needed">
                </div>
                <div class="form-group">
                <label for="max_temperature" class="col-form-label">Temperatura max:</label>
                <input type="number" class="form-control" id="max_temperature">
                </div>
                <div class="form-group">
                <label for="min_temperature" class="col-form-label">Temperatura min:</label>
                <input type="number" class="form-control" id="min_temperature">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>