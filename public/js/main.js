$( document ).ready(function() {
    setInterval(function() {
        getNextBookings();
    }, 30000);

    $('#snooze').on('click', function (e){
        e.preventDefault();
        console.log('snooze clicked');
        $("#alarm")[0].pause();
    })
    getNextBookings();
});

const getNextBookings = function(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/bookings/get/all",
        type: "get",
        success: function (response) {
            console.log(response);
            if(!response.error){
                let playAlaram = false;

                $('.next-bookings-table').html("")
                response.data.forEach(item => {
                    let alarm = '';
                    const date = new Date(item.next_date);
                    const today = new Date();

                    let msDifference =  date - today;
                    let minutes = Math.floor(msDifference/1000/60);
                    if(minutes < 20 ){
                        playAlaram = true;
                        alarm = 'alarm';
                    }
                    let showDate = date.getHours()+':'+date.getMinutes();
                    let row = '<tr class="'+alarm+'"><td>'+showDate+'</td><td>'+item.name+'</td><td>'+item.note+'</td>' +
                        '<td>' +
                        '<a href="/bookings/update/'+item.id+'" class="btn btn-primary">Прифатено</a>'
                        '</td>' +
                        '</tr>'
                    $('.next-bookings-table').append(row);
                })
                if(playAlaram){
                    $("#alarm")[0].play();
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}
