import "./bootstrap";
import './map';


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
            duration = 3000
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


