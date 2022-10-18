import "./bootstrap";
import './map';
import './formatNumber';
import './swipers';


$(document).ready(function () {
    //Add on change to each input type range
    $("input[type=range]").on("change", function () {
        //Get the value of the input
        var value = $(this).val();
        //Get the id of the input
        var id = $(this).attr("id");
        //Get the label of the input
        var small = $("small[data-target=" + id + "]");
        //Set the label text to the value of the input
        small.text(value);
    });
    $('input[type=tel]').each(function() {
        $(this).formatPhoneNumber({
            format: '(###) ###-####'
        })
    })
    
    //if add to cart btn clicked
    $('.button_cart').on('click', function() {
        let cart = $('.cart-nav');
        // find the img of that card which button is clicked by user
        let imgtodrag = $(this).parent('.card').find("img").eq(0);
        if (imgtodrag) {
            // duplicate the img
            var imgclone = imgtodrag.clone().offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            }).css({
                'opacity': '0.8',
                'position': 'absolute',
                'height': '150px',
                'width': '150px',
                'z-index': '100'
            }).appendTo($('body')).animate({
                'top': cart.offset().top + 20,
                'left': cart.offset().left + 30,
                'width': 75,
                'height': 75
            }, 1000, 'easeInOutExpo');
          
            imgclone.animate({
                'width': 0,
                'height': 0
            }, function() {
                $(this).detach()
            });
        }
    });
});
window.onload = function () {
    let finalCart = JSON.parse(localStorage.getItem("cart"));
    Livewire.emit("updatedCart", finalCart);
    const icons = ["success", "error", "warning", "info", "question"];
    const positions = [
        "top",
        "top-start",
        "top-end",
        "center",
        "center-start",
        "center-end",
        "bottom",
        "bottom-start",
        "bottom-end",
    ];
    Livewire.on(
        "alert",
        (
            message = "Prueba",
            type = "success",
            position = "bottom-end",
            duration = 3000,
        ) => {
            //Check if type and position are valids
            if (!icons.includes(type)) {
                type = "success";
            }
            if (!positions.includes(position)) {
                position = "bottom-end";
            }

            Toast.fire({
                icon: type,
                title: message,
                iconColor: "white",
                customClass: {
                    popup: "colored-toast",
                },
                position: position,
                timer: duration,
            });
        }
    );
};
//Swal set text color

const Toast = Swal.mixin({
    toast: true,
    showConfirmButton: false,
    showCloseButton: true,

    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});



