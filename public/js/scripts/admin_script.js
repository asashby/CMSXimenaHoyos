$(function(){
    $('#currentPassword').keyup(function(){
        var currentPwd = $('#currentPassword').val();
        $.ajax({
            type: 'post',
            url: '/dashboard/verify-curr-pwd',
            data: { currentPwd },
            success: function(res){
                if(!res){
                    $('#verCurrPwd').html('<font color=red>La contraseña actual no es correcta</font>')
                }else{
                    $('#verCurrPwd').html('<font color=green>La contraseña actual es correcta</font>')
                }
            },error: function(){
                alert('error');
            }
        })
    });


    $('.update-status').click(function(){
        var status = $(this).text();
        var section_id = $(this).attr('section_id');
        $.ajax({
            type: 'post',
            url: '/dashboard/upd-section-status',
            data: { status, section_id },
            success: function(res){
                if(res['status'] == 0){
                    $('#section-'+res['section_id']).attr('class', 'badge badge-danger update-status').html('Desactivado');
                }else if(res['status'] == 1) {
                    $('#section-'+res['section_id']).attr('class', 'badge badge-success update-status').html('Activado');
                }
            },error: function(){
                alert('error');
            }
        })
    });

    var item_slide = $('.item-slide');

     // jQuery UI sortable for the todo list
    $('.todo-list').sortable({
        placeholder         : 'sort-highlight',
        handle              : '.handle',
        forcePlaceholderSize: true,
        zIndex              : 999999,
        stop:   function(event){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                }
            });
            for(var i = 0; i < item_slide.length; i ++){
                var objective = event.target.children[i].attributes['data-target'].value;
                var datos = new FormData();
                datos.append(`id_${objective}`,  event.target.children[i].id);
                datos.append('order',  i+1);
                $.ajax({
                    type: 'post',
                    url: `/dashboard/${objective}/upd-${objective}-order`,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    data: datos,
                    success: function(res){

                    },error: function(){
                        console.log('error');
                    }
                })
            }
        }
    })

    $(document).on('click' ,'.confirmDelete' , function(){
        var recordId = $(this).attr('recordId');
        var record = $(this).attr('record');
        Swal.fire({
            title: 'Estas Seguro?',
            text: "no se podra deshacer la accion!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/dashboard/${record}/delete/${recordId}`;
            }
        })
    })

    $(document).on('click' ,'.addRow' , function(){
        var table = document.getElementById("attributes");
        var macro = $('#key').val();
        var quantity = $('#value').val();
        var row = table.insertRow(table.length);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        row.setAttribute('macro',macro);
/*         macroArr.push({
            macro,
            quantity
        }); */
        cell1.innerHTML = macro;
        cell2.innerHTML = quantity;
        cell3.innerHTML = `<a href="javascript:void(0)" id="DeleteButton" style="cursor: pointer;" title="Eliminar"><i style="color: red;" class="fas fa-trash-alt"></i></a>`;
        var tableAttr = document.getElementById('attributes');
        var macroArr = [];
        for ( var i = 1; i < tableAttr.rows.length; i++ ) {
            macroArr.push({
                macro: tableAttr.rows[i].cells[0].innerHTML,
                quantity: tableAttr.rows[i].cells[1].innerHTML,
            });
        }
        $('input[name="attributes"]').val(JSON.stringify(macroArr));
        $('#key').val('');
        $('#value').val('');
    })

    $("#attributes").on("click", "#DeleteButton", function() {
        $(this).closest("tr").remove();
        var tableAttr = document.getElementById('attributes');
        var macroArr = [];
        for ( var i = 1; i < tableAttr.rows.length; i++ ) {
            macroArr.push({
                macro: tableAttr.rows[i].cells[0].innerHTML,
                quantity: tableAttr.rows[i].cells[1].innerHTML,
            });
        }
        $('input[name="attributes"]').val(JSON.stringify(macroArr));
    });

    $(document).on("click", "#excercises", function(){
        $("#unitsListModal #courseModalLabel").text($(this).attr('data-title'));
        var idCourse = $(this).attr('data-id');
        $.ajax({
            url: `/dashboard/courses/${idCourse}/units`,
            success: function(units){
                $(".data-units-course .todo-list .item-slide").remove();
                units.forEach(unit => {
                    $(".data-units-course .todo-list").append(`
                    <li class="item-slide" id="{{$section->id}}" data-target="unit">
                    <!-- drag handle -->
                    <span class="handle ui-sortable-handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <!-- todo text -->
                    <span class="text">Día ${ unit.day }</span>
                    -
                    <span class="text">${ unit.title }</span>
                    <!-- Emphasis label -->
                    <!-- General tools such as edit or delete-->
                </li>`);
                });
            },error: function(){
                alert('error');
            }
        })
    });

    $(document).on('click' ,'.addIngredient' , function(){
        var ingredient = $("input[id='recipeIngredient']").val();
        $('#ingredients-list').append(`
            <li order="${ingredient}" class="item" data-target="unit">
                <!-- drag handle -->
                <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                </span>
                <!-- checkbox -->
                <!-- todo text -->
                <p class="text">${ingredient}</p>
                <!-- Emphasis label -->
                <!-- General tools such as edit or delete-->
                <div class="tools deleteIngredient">
                    <a href="javascript:void(0)" id="deleteBtn" style="cursor: pointer;" title="Eliminar"><i style="color: red;" class="fas fa-trash-alt"></i></a>
                </div>
            </li>`)
            let list = document.getElementById('ingredients-list').getElementsByClassName('item');
            var ingredientArray = [];
            for ( var i = 0; i < list.length; i++ ) {
                ingredientArray.push(list[i].getAttribute('order'))
            }
            $('input[name="ingredientsRecipe"]').val(JSON.stringify(ingredientArray));
        $("input[id='recipeIngredient']").val('');

    })


     // arreglo que estoy creando para enviar
    $(document).on('click' ,'.addStep' , function(){
        var stepOrder = $("input[id='stepOrder']").val();
        var step = $("textarea[id='recipeStep']").val();
        $('#step-list').append(`
        <li class="item-list" order="${stepOrder}" description="${step}">
            <div class="card card-primary collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Paso ${stepOrder}</h3>
                    <div class="card-tools">
                        <a href="javascript:void(0)" id="deletestep" style="cursor: pointer;" title="Eliminar"><i style="color: red;" class="fas fa-trash-alt"></i></a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                <!-- /.card-tools -->
                </div>
                <div class="card-body" style="display: block;">
                    <p>${step}</p>
                </div>
                    <!-- /.card-body -->
            </div>
        </li>`)
        let steps = document.getElementById('step-list').getElementsByClassName('item-list');
        var stepArray = [];
        for ( var i = 0; i < steps.length; i++ ) {
            stepArray.push({
                step: parseInt(steps[i].getAttribute('order')),
                description: steps[i].getAttribute('description')
            })
        }
        $('input[name="stepsRecipe"]').val(JSON.stringify(stepArray.sort(function(a, b){return a.step - b.step})));
        $("input[id='stepOrder']").val('');
        $("textarea[id='recipeStep']").val('');
    })

    $(document).on('click' ,'#deleteBtn' , function(){
        $(this).parent().parent().remove();
        let list = document.getElementById('ingredients-list').getElementsByClassName('item');
        var ingredientArray = [];
        for ( var i = 0; i < list.length; i++ ) {
            ingredientArray.push(list[i].getAttribute('order'))
        }
        $('input[name="ingredientsRecipe"]').val(JSON.stringify(ingredientArray));
    });

    $(document).on('click' ,'#deletestep' , function(){
        $(this).parent().parent().parent().parent().remove();
        let steps = document.getElementById('step-list').getElementsByClassName('item-list');
        var stepArray = [];
        for ( var i = 0; i < steps.length; i++ ) {
            stepArray.push({
                step: parseInt(steps[i].getAttribute('order')),
                description: steps[i].getAttribute('description')
            })
        }
        $('input[name="stepsRecipe"]').val(JSON.stringify(stepArray));
    });


    $(document).on('change', '#course_id', function(){
        let value = $(this).val();
        $.ajax({
            url: `/course/${value}/units`,
            type: 'get',
            success: function(data){
                $("#unit_id").empty();
                $("#unit_id").append(`<option value="0"  selected disabled>Seleccione Día</option>`);
                data.forEach((item) =>{
                    $("#unit_id").append(`<option value="${item.id}">Day ${item.day} - ${item.title}</option>`);
                });
            }
        });
    })

    let courseId = 0;
    let unitId = 0;

    $(document).on('change', '#course_id_2', function(){
        courseId = $(this).val();
        $.ajax({
            url: `/courses/${courseId}/units`,
            type: 'get',
            success: function(data){
                $("#day_id").empty();
                data.forEach((item) =>{
                    $("#day_id").append(`<option value="${item.id}">Day ${item.day} - ${item.title}</option>`);
                });
            }
        });
    })


    $(document).on('change', '#course_id_2', function(){
        courseId = $(this).val();
        $.ajax({
            url: `/courses/${courseId}/units`,
            type: 'get',
            success: function(data){
                $("#day_id").empty();
                $("#day_id").append(`<option value="0" selected disabled >Seleccione un Día</option>`);
                data.forEach((item) =>{
                    $("#day_id").append(`<option value="${item.id}">Day ${item.day} - ${item.title}</option>`);
                });
            }
        });
    })


    function getExcercises(unitId) {
        let url = `/list-questions/${unitId}/unit`;
        axios.get(url).then(function (response) {
            $('.table-questions').empty();
            $('.table-questions').html(response.data);
            $('#questionsTable').DataTable({responsive: true});
        }).catch(function (error) {
            console.log(error);
        });
    }

    $(document).on('change', '#day_id', function(){
        unitId = $(this).val();
        getExcercises(unitId);
        console.log('he cambiado de opcion');
    })
})
