$(document).ready(function() {

    // keyup обрабатывает события. Когда user нажимает кнопку, вводя значения в поле - он срабатывает
    // В файле index.php полю для поиска присвоен id='search'

    $("#search").keyup(function() {
        
   // Записываем в переменную 'name' значение из поля для поиска
 
        var name = $('#search').val();
        
    // Проверяем значение переменной на пустоту
        
        if (name === "") {
            
    //Если 'name' пустая, то блок div c id = 'display' будет очищен

            $("#display").html("");

        }
        else {
    //Иначе вызываем ajax - функцию

            $.ajax({

                type: "POST", //Тип запроса
                url: "script.php", //Путь к обработчику
                data: {
                    
                    search: name 
                },
                success: function(response) {
                    // Если запрос успешный, то добавляем результат в div с id = 'dispay'
                    $("#display").html(response).show();
                }

            });

        }

    });

});

function fill(Value) {
    // Эта функция обрабатывает клик мышью по результам выдачи поиска

    $('#search').val(Value); //Добавляем в поле поиска значение результата

    $('#display').hide(); //Скрываем остальные результаты

}
