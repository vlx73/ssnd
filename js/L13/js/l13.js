// document ready event
$(document).ready(function () {

    // AJAx example
    $.ajax({
        url: 'https://jsonplaceholder.typicode.com/users',
        type: 'GET',
        dataType: 'json',
    })
        .done(function (data) {
            console.log(data);
            data.forEach(function (user) {
                $('#myTable').append(
                    '<tr><td>' + user.name + '</td><td>' + user.email + '</td><td>' + user.phone +
                    '</td><td>' + user.website + '</td></tr>'
                );
            });
        });

    // $.getJSON('https://jsonplaceholder.typicode.com/users', function (data) {
    //     data.forEach(function (user) {
    //         $('#myTable').append(
    //             '<tr><td>' + user.name + '</td><td>' + user.email + '</td><td>' + user.phone +
    //             '</td><td>' + user.website + '</td></tr>'
    //         );
    //     });
    // });

});

// event listeners
// $("#needle").focus(function () {
//     $(this).css("background-color", "#fefbd8");
// });
//
// $("#needle").blur(function () {
//     $(this).css("background-color", "#ffffff");
// });


// $("#needle")
//     .focus(function () {
//         $(this).css("background-color", "#cccccc");
//     })
//     .blur(function () {
//         $(this).css("background-color", "#ffffff");
//     });

// search table
// $('#needle').on('keyup', function () {
//     let value = $(this).val().toLowerCase();
//     console.log(value);
//     $('#myTable tr').filter(function () {
//         console.log('tr: ', $(this));
//         console.log('text part: ', $(this).text());
//         console.log('tr index: ', $(this).text().toLowerCase().indexOf(value));
//
//         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
//     });
// });