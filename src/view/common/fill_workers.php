
<script>
    let workers = [];
    function setTable() {
        var bodyWorkers = document.getElementById('bodyWorkers');
        let table = "";
        var i = 1;
        workers.forEach(element => {
            table += "<tr><td>" + i + "</td><td>" + element.name + "</td><td>" + element.lastName + "</td><td>" + element.dni + "</td><td><button type='button' id='" + element.dni + "' class='btn btn-danger'>Eliminar</button></td><td> <button type='button' id='" + element.dni + "_editar' class='btn btn-danger'>Editar</button></td><tr>";
            i++;
        });
        bodyWorkers.innerHTML = table;

        workers.forEach(element => {
            var deleteWork = document.getElementById(element.dni);
            deleteWork.addEventListener('click', click => {
                console.log(element.dni)
                workers = workers.filter(worker => worker.dni != element.dni);
                setTable();
            });

            var editWork = document.getElementById(element.dni + '_editar');
                editWork.addEventListener('click', click => {
                    console.log(element.dni)
                    let updateWork = workers.filter(worker => worker.dni == element.dni);

                    console.log(updateWork);
                    setUpdateWorker(updateWork)
                    setTable();
                });
        });


    }
    function setworker(datos){
    workers.push({
                    "name": datos.name,
                    "lastName": datos.last_name,
                    "dni": datos.document_number,
                    "email": datos.email,
                    "city": datos.city,
                    "position": datos.position,
                    "empresa": datos.company_name,
                    "invitado": datos.guest

                });

}
    <?php 
    if($workers != null) {
        foreach ($workers as $item) {
                        
        
            ?> 
            setworker(<?php echo json_encode($item); ?>)
            
           <?php  
        }
       ?> setTable();
       <?php   
       
    }
    
    ?>
    
</script>
