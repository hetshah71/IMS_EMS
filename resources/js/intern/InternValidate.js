import $ from "jquery";
import "jquery-validation";
window.$ = window.jQuery = $;

 $(document).ready(function () {
     $("#messageForm").validate({
         rules: {
             content: {
                 required: true,
                 minlength: 1,
             },
         },
         messages: {
             content: {
                 required: "Please enter a message.",
                 minlength: "Message cannot be empty.",
             },
         },
         errorClass: "text-red-500 text-sm mt-1",
         highlight: function (element) {
             $(element).addClass("border-red-500");
         },
         unhighlight: function (element) {
             $(element).removeClass("border-red-500");
         },
         errorPlacement: function (error, element) {
             error.insertAfter(element);
         },
         });
     });
        