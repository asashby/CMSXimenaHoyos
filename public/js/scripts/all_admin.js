//Variables globales para questions & answers
let status = 1;
let answer_valid = 1;
let question_id = 0;

$(document).ready(function () {
    $('.js-example-basic-single').select2();
    $('.js-select-question').select2();
});

//SECCION DE UNIDADES *********************+


//Metodo ordenar unidades
$(document).on('click', '.list-units-course', function () {
    let id = $(this).data('id');
    let title = $(this).data('title');

    getUnitsByCourseModal(id);
    $('#courseModalLabel').text(title);

});

function getUnitsByCourseModal(id) {
    let url = "list-units/" + id + "/modal/course";
    axios.get(url).then(function (response) {
        $('.data-units-course').empty();
        $('.data-units-course').html(response.data);


        var unit_item = $('.unit-item');
        console.log(unit_item);
        $('.todo-list').sortable(
            {
                placeholder: 'sort-highlight',
                handle: '.handle',
                forcePlaceholderSize: true,
                zIndex: 999999,
                stop: function (event) {
                    for (var i = 0; i < unit_item.length; i++) {
                        var datos = new FormData();
                        datos.append('unit_id', event.target.children[i].id);
                        datos.append('order', i + 1);
                        $.ajax({
                            type: 'post',
                            url: '/dashboard/units/order',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            data: datos,
                            success: function (res) {
                                // toastr.success('¡Orden cambiado con exíto!');
                            }, error: function () {
                                // toastr.error('¡Error al  cambiar el orden!');
                            }
                        })
                    }
                }
            }
        );


    }).catch(function (error) {
        console.log(error);
    });
}

//METODOS PARA LISTAR PREGUNTAS RELACIONADAS A UNA UNIDAD

$(document).on('click', '.list-questions-unit', function () {
    let id = $(this).data('id');
    let title = $(this).data('title');

    getQuestionsUnit(id);
    $('#unitModalLabel').text(title);
});
$(document).on("change", ".selected-filter-course", function (e) {
    let id = $(this).val();
    getDataUnitsByCourse(id);
});

function getDataUnitsByCourse(id) {
    let url = "list-units/" + id + "/course";
    axios.get(url).then(function (response) {
        $('.table-units-course').empty();
        $('.table-units-course').html(response.data);
        $('#sectionsTable').DataTable({responsive: true});
    }).catch(function (error) {
        console.log(error);
    });
}

//Método para obetener la tabla de preguntas de una unidad
function getQuestionsUnit(id) {
    let url = "list-questions-units/" + id;
    axios.get(url).then(function (response) {
        $('.data-questions').empty();
        $('.data-questions').html(response.data);
    }).catch(function (error) {
        console.log(error);
    });
}

//Método delete type_answer_questions
$(document).on('click', '.delete-answer-btn', function () {
    let id = $(this).data('id');
    let question_id = $(this).data('question');
    let url = 'answers-questions/' + id + '/delete';
    Swal.fire({
        title: '¿Estas Seguro?',
        text: "No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(url).then(function (response) {
                toastr.success('¡Registro eliminado con exíto!')
                getQuestionAnswers(question_id);
            }).catch(error => {
                toastr.error('Error en la petición ')
            });
        }
    });


});

//Método para eliminar la imagen de una unidad
$(document).on('click', '.delete_image_unit', function () {
    let id = $(this).data('id');
    let url = '../../units/' + id + '/delete/file';
    Swal.fire({
        title: '¿Estas Seguro?',
        text: "No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(url).then(function (response) {
                $('#input_image').empty();
                $('#input_image').html(response.data);
                toastr.success('¡Imagen eliminada con exíto!');
                document.getElementById("url_image").addEventListener("change", readFile);
            }).catch(error => {
                toastr.error('Error en la petición ');
            });
        }
    });

});


//Método para eliminar la banner de una unidad
$(document).on('click', '.delete_banner_unit', function () {
    let id = $(this).data('id');
    let url = '../../units/' + id + '/delete/file';
    Swal.fire({
        title: '¿Estas Seguro?',
        text: "No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(url).then(function (response) {
                $('#input_image').empty();
                $('#input_image').html(response.data);
                toastr.success('¡Imagen eliminada con exíto!');
                document.getElementById("url_image2").addEventListener("change", readFile);
            }).catch(error => {
                toastr.error('Error en la petición ');
            });
        }
    });

});


//Método para activar o desactivar las unidades
$(document).on('click', '.activated_unit', function () {
    let id = $(this).data('id');
    let url = 'units/' + id + '/status';
    axios.patch(url).then(function (response) {
        toastr.success('¡Registro actualizado con exíto!')
    }).catch(error => {
        toastr.error('Error en la petición ')
    });
});

//Método para activar o desactivar los usuarios
$(document).on('click', '.activated_user', function () {
    let id = $(this).data('id');
    let url = 'users/' + id + '/status';
    axios.patch(url).then(function (response) {
        toastr.success('¡Registro actualizado con exíto!')
    }).catch(error => {
        toastr.error('Error en la petición ')
    });
});

//Método para activar o desactivar los cursos
$(document).on('click', '.activated_course', function () {
    let id = $(this).data('id');
    let url = 'courses/' + id + '/status';
    axios.patch(url).then(function (response) {
        toastr.success('¡Registro actualizado con exíto!')
    }).catch(error => {
        toastr.error('Error en la petición ')
    });
});

//Método para activar o desactivar pregunta
$(document).on('click', '.activated_question', function () {
    let id = $(this).data('id');
    let url = 'questions/' + id + '/status';
    axios.patch(url).then(function (response) {
        toastr.success('¡Registro actualizado con exíto!')
    }).catch(error => {
        toastr.error('Error en la petición ')
    });
});

//Método para obetener la tabla de alternativas de una pregunta
function getQuestionAnswers(id) {
    let url = "list-answers-questions/" + id;
    axios.get(url).then(function (response) {
        $('.data-answers').empty();
        $('.data-answers').html(response.data);
    }).catch(function (error) {
        console.log(error);
    });
}

$(document).on('click', '.valid_answer', function () {
    let id = $(this).data('id');
    let url = 'validated-answers-questions/' + id;
    axios.patch(url).then(function (response) {
        toastr.success('¡Registro actualizado con exíto!')
    }).catch(error => {
        toastr.error('Error en la petición ')
    });
});
$(document).on('click', '.status_answer', function () {
    let id = $(this).data('id');
    let url = 'status-answers-questions/' + id;
    axios.patch(url).then(function (response) {
        toastr.success('¡Estado cambiado con exíto!')
    }).catch(error => {
        toastr.error('Error en la petición ')
    });
});
$("#some_id").attr("checked") ? 1 : 0;

$('input[name="status"]').change(function () {
    status = $('input[name="status"]:checked').val();

});
$('input[name="type_answer_valid"]').change(function () {
    answer_valid = $('input[name="type_answer_valid"]:checked').val();

});

$(document).on('click', '.add-new-question', function () {
    question_id = $(this).data('id');
});
$(document).on('click', '.add-answer', function () {
    let title = $('#title').val();
    let message = $('#message').val();
    let type_answer_id = $('#type_answer_id').val();
    status = $('input[name="status"]:checked').val();
    console.log('----------');
    console.log(status);
    answer_valid = $('input[name="type_answer_valid"]:checked').val();
    console.log(answer_valid);

    let url = "type-answers-questions";
    axios.post(url, {
        'title': title,
        'message': message,
        'type_answer_id': type_answer_id,
        'status': status,
        'type_answer_valid': answer_valid,
        'question_id': question_id
    }).then(function (response) {
        $('#answerModal').modal('hide');

        Swal.fire(
            '¡Agregado!',
            'El tarea se ha cumplido exitosamente.',
            'success'
        );
        resetValues();
    }).catch(error => {
        if (error.response) {
            let errors = [];
            errors = error.response.data.errors;
            let message = errors[Object.keys(errors)[0]];
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message
            })
        }
    });
});
$(document).on('click', '.cancel-answer', function () {
    resetValues();
});
$(document).on('click', '.list-question-answers', function () {
    let id = $(this).data('id');
    getQuestionAnswers(id);
});

function resetValues() {
    question_id = 0;
    $('#title').val('');
    $('#message').val('');
    $('.textAreaEditor').summernote('destroy');
    $('.textAreaEditor').summernote();
}

//USERS PROGRESS COURSES
function getUnitCourseByUser(course_id, user_id) {
    let url = "course/" + course_id + '/user/' + user_id + '/units';
    axios.get(url).then(function (response) {
        $('.data-units-user').empty();
        $('.data-units-user').html(response.data);
    }).catch(function (error) {
        console.log(error);
    });
}

function getData(id) {
    let url = "courses-detail-course/" + id;
    axios.get(url).then(function (response) {
        $('.detail_course').empty();
        $('.detail_course').html(response.data.detail);
        $('.users_list').empty();
        $('.users_list').html(response.data.users);
        $('#tb_users').DataTable({responsive: true});
    }).catch(function (error) {
        console.log(error);
    });
}

$(document).on('click', '.units_user_course', function () {

    let course_id = $(this).data('course');
    let user_id = $(this).data('user');
    getUnitCourseByUser(course_id, user_id);

});

$(document).on('click', '.delete_user_course', function () {
    let id = $(this).data('id');
    let course_id = $(this).data('course');
    let url = 'user-courses/' + id + '/delete';
    Swal.fire({
        title: '¿Estas Seguro?',
        text: "En desvincular al usuario del curso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(url).then(function (response) {
                toastr.success('¡Registro eliminado con exíto!')
                getData(course_id);
            }).catch(error => {
                toastr.error('Error en la petición ')
            });
        }
    });
});

$(document).on("change", ".selected-course", function (e) {
    let id = $(this).val();
    getData(id);
});

/// ITEM DELETE TABLE
$(document).on('click', '.delete-item-table', function () {
    let id = $(this).data('id');
    let class_form = '.delete-item' + id;
    Swal.fire({
        title: '¿Estas Seguro?',
        text: "No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $(class_form).submit();
        }
    });
});


//UPLOAD IMAGE ON CONTAINER
function readFile() {
    if (this.files && this.files[0]) {
        var FR = new FileReader();
        FR.addEventListener("load", function (e) {
            document.getElementById("show_img").src = e.target.result;
        });
        FR.readAsDataURL(this.files[0]);
    }
}

function readFile2() {
    if (this.files && this.files[0]) {
        var FR = new FileReader();
        FR.addEventListener("load", function (e) {
            document.getElementById("show_img_mobile").src = e.target.result;
        });
        FR.readAsDataURL(this.files[0]);
    }
}

/* function readFile3() {
    if (this.files && this.files[0]) {
        var FR = new FileReader();
        FR.addEventListener("load", function (e) {
            document.getElementById("show_banner").src = e.target.result;
        });
        FR.readAsDataURL(this.files[0]);
    }
}
 */
function readFile4() {
    if (this.files && this.files[0]) {
        var FR = new FileReader();
        FR.addEventListener("load", function (e) {
            document.getElementById("show_icon").src = e.target.result;
        });
        FR.readAsDataURL(this.files[0]);
    }
}

document.getElementById("url_image").addEventListener("change", readFile);
document.getElementById("mobile_image").addEventListener("change", readFile2);
// document.getElementById("url_banner").addEventListener("change", readFile3);
document.getElementById("url_icon").addEventListener("change", readFile4);

