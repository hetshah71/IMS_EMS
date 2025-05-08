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
         errorPlacement: function (error, element) {
             error.insertAfter(element);
         },
        });
    });
$('#createTaskForm').validate({
            rules: {
                title: {
                    required: true,
                    minlength: 3
                },
                description: {
                    required: true,
                    minlength: 5
                },
                due_date: {
                    required: true,
                    date: true
                },
                status: {
                    required: true
                },
                'interns[]': {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "Please enter a title.",
                    minlength: "Title must be at least 3 characters."
                },
                description: {
                    required: "Please enter a description.",
                    minlength: "Description must be at least 5 characters."
                },
                due_date: {
                    required: "Please select a due date.",
                    date: "Please enter a valid date."
                },
                status: {
                    required: "Please select a status."
                },
                'interns[]': {
                    required: "Please assign at least one intern."
                }
            },
            errorClass: 'text-red-500 text-sm mt-1',
            errorPlacement: function (error, element) {
                if (element.attr("name") == "interns[]") {
                    error.insertAfter($('#interns').parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) {
                $(element).addClass('border-red-500');
            },
            unhighlight: function (element) {
                $(element).removeClass('border-red-500');
            }
});
$("#editTaskForm").validate({
    rules: {
        title: {
            required: true,
            minlength: 3,
        },
        description: {
            required: true,
            minlength: 5,
        },
        due_date: {
            required: true,
            date: true,
        },
        status: {
            required: true,
        },
        "interns[]": {
            required: true,
        },
    },
    messages: {
        title: {
            required: "Please enter a title.",
            minlength: "Title must be at least 3 characters.",
        },
        description: {
            required: "Please enter a description.",
            minlength: "Description must be at least 5 characters.",
        },
        due_date: {
            required: "Please select a due date.",
            date: "Please enter a valid date.",
        },
        status: {
            required: "Please select a status.",
        },
        "interns[]": {
            required: "Please assign at least one intern.",
        },
    },
    errorClass: "text-red-500 text-sm mt-1",
    errorPlacement: function (error, element) {
        if (element.attr("name") === "interns[]") {
            error.insertAfter($("#interns").parent());
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    },
});
$("#createInternForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 3,
        },
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 6,
        },
        password_confirmation: {
            required: true,
            equalTo: "#password",
        },
        department: {
            required: true,
            minlength: 2,
        },
    },
    messages: {
        name: {
            required: "Please enter the intern's name.",
            minlength: "Name must be at least 3 characters long.",
        },
        email: {
            required: "Please enter an email address.",
            email: "Please enter a valid email.",
        },
        password: {
            required: "Please provide a password.",
            minlength: "Password must be at least 6 characters.",
        },
        password_confirmation: {
            required: "Please confirm the password.",
            equalTo: "Passwords do not match.",
        },
        department: {
            required: "Please enter a department.",
            minlength: "Department must be at least 2 characters.",
        },
    },
    errorClass: "text-red-500 text-sm mt-1",
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    },
});
 $("#editInternForm").validate({
     rules: {
         name: {
             required: true,
             minlength: 3,
         },
         email: {
             required: true,
             email: true,
         },
         department: {
             required: true,
             minlength: 2,
         },
         password: {
             minlength: 6,
         },
         password_confirmation: {
             equalTo: "#password",
         },
     },
     messages: {
         name: {
             required: "Please enter the intern's name.",
             minlength: "Name must be at least 3 characters.",
         },
         email: {
             required: "Please enter an email address.",
             email: "Enter a valid email.",
         },
         department: {
             required: "Please enter a department.",
             minlength: "Department must be at least 2 characters.",
         },
         password: {
             minlength: "Password must be at least 6 characters.",
         },
         password_confirmation: {
             equalTo: "Passwords do not match.",
         },
     },
     errorClass: "text-red-500 text-sm mt-1",
     errorPlacement: function (error, element) {
         error.insertAfter(element);
     },
     highlight: function (element) {
         $(element).addClass("border-red-500");
     },
     unhighlight: function (element) {
         $(element).removeClass("border-red-500");
     },
 });
  $("#assignTaskForm").validate({
      rules: {
          intern_id: {
              required: true,
          },
          task_id: {
              required: true,
          },
      },
      messages: {
          intern_id: {
              required: "Please select an intern.",
          },
          task_id: {
              required: "Please select a task.",
          },
      },
      errorClass: "text-red-500 text-sm mt-1",
      errorPlacement: function (error, element) {
          error.insertAfter(element);
      },
      highlight: function (element) {
          $(element).addClass("border-red-500");
      },
      unhighlight: function (element) {
          $(element).removeClass("border-red-500");
      },
  });
  $("#createAdminForm").validate({
      rules: {
          name: { required: true },
          email: {
              required: true,
              email: true,
          },
          password: {
              required: true,
              minlength: 6,
          },
          password_confirmation: {
              required: true,
              equalTo: "#password",
          },
          department: { required: true },
          position: { required: true },
          "roles[]": { required: true },
      },
      messages: {
          name: "Please enter the name.",
          email: {
              required: "Please enter an email.",
              email: "Enter a valid email.",
          },
          password: {
              required: "Please enter a password.",
              minlength: "Password must be at least 6 characters.",
          },
          password_confirmation: {
              required: "Please confirm your password.",
              equalTo: "Passwords do not match.",
          },
          department: "Please enter the department.",
          position: "Please enter the position.",
          "roles[]": "Please select at least one role.",
      },
      errorClass: "text-red-600 text-sm mt-1",
      errorPlacement: function (error, element) {
          if (element.attr("name") === "roles[]") {
              error.insertAfter("#roles");
          } else {
              error.insertAfter(element);
          }
      },
      highlight: function (element) {
          $(element).addClass("border-red-500");
      },
      unhighlight: function (element) {
          $(element).removeClass("border-red-500");
      },
  });
  $("#editAdminForm").validate({
      rules: {
          name: { required: true },
          email: {
              required: true,
              email: true,
          },
          password: {
              minlength: 6,
          },
          password_confirmation: {
              equalTo: "#password",
          },
          department: { required: true },
          position: { required: true },
          "roles[]": { required: true },
      },
      messages: {
          name: "Please enter the name.",
          email: {
              required: "Please enter an email.",
              email: "Enter a valid email.",
          },
          password: {
              minlength: "Password must be at least 6 characters.",
          },
          password_confirmation: {
              equalTo: "Passwords do not match.",
          },
          department: "Please enter the department.",
          position: "Please enter the position.",
          "roles[]": "Please select at least one role.",
      },
      errorClass: "text-red-600 text-sm mt-1",
      errorPlacement: function (error, element) {
          if (element.attr("name") === "roles[]") {
              error.insertAfter("#roles");
          } else {
              error.insertAfter(element);
          }
      },
      highlight: function (element) {
          $(element).addClass("border-red-500");
      },
      unhighlight: function (element) {
          $(element).removeClass("border-red-500");
      },
  });
  $("#createRoleForm").validate({
      rules: {
          name: {
              required: true,
              minlength: 3,
          },
          "permissions[]": {
              required: true,
          },
      },
      messages: {
          name: {
              required: "Please enter a role name.",
              minlength: "Role name must be at least 3 characters long.",
          },
          "permissions[]": {
              required: "Please select at least one permission.",
          },
      },
      errorClass: "text-red-600 text-sm mt-1",
      errorPlacement: function (error, element) {
          if (element.attr("name") === "permissions[]") {
              error.insertAfter(
                  $(".permission-checkbox").last().closest("div")
              );
          } else {
              error.insertAfter(element);
          }
      },
      highlight: function (element) {
          $(element).addClass("border-red-500");
      },
      unhighlight: function (element) {
          $(element).removeClass("border-red-500");
      },
  });
  $("#editRoleForm").validate({
      rules: {
          name: {
              required: true,
              minlength: 3,
          },
          "permissions[]": {
              required: true,
          },
      },
      messages: {
          name: {
              required: "Please enter a role name.",
              minlength: "Role name must be at least 3 characters long.",
          },
          "permissions[]": {
              required: "Please select at least one permission.",
          },
      },
      errorClass: "text-red-600 text-sm mt-1",
      errorPlacement: function (error, element) {
          if (element.attr("name") === "permissions[]") {
              error.insertAfter(
                  $(".permission-checkbox").last().closest("div")
              );
          } else {
              error.insertAfter(element);
          }
      },
      highlight: function (element) {
          $(element).addClass("border-red-500");
      },
      unhighlight: function (element) {
          $(element).removeClass("border-red-500");
      },
  });
   $(".permission-name").on("input", function () {
       let slug = $(this)
           .val()
           .toLowerCase()
           .replace(/[^a-z0-9]+/g, "-")
           .replace(/^-+|-+$/g, "");
       $(".permission-slug").val(slug);
   });
   $("#create-permission-form").validate({
       rules: {
           name: {
               required: true,
               minlength: 3,
           },
           slug: {
               required: true,
               minlength: 3,
           },
       },
       messages: {
           name: {
               required: "Please enter a permission name.",
               minlength: "Permission name must be at least 3 characters long.",
           },
           slug: {
               required: "Please enter a permission slug.",
               minlength: "Permission slug must be at least 3 characters long.",
           },
       },
       errorClass: "text-red-600 text-sm mt-1",
       errorPlacement: function (error, element) {
           error.insertAfter(element);
       },
       highlight: function (element) {
           $(element).addClass("border-red-500");
       },
       unhighlight: function (element) {
           $(element).removeClass("border-red-500");
       },
   });
   $("#edit-permission-form").validate({
       rules: {
           name: {
               required: true,
               minlength: 3,
           },
           slug: {
               required: true,
               minlength: 3,
           },
       },
       messages: {
           name: {
               required: "Please enter a permission name.",
               minlength: "Permission name must be at least 3 characters long.",
           },
           slug: {
               required: "Please enter a permission slug.",
               minlength: "Permission slug must be at least 3 characters long.",
           },
       },
       errorClass: "text-red-600 text-sm mt-1",
       errorPlacement: function (error, element) {
           error.insertAfter(element);
       },
       highlight: function (element) {
           $(element).addClass("border-red-500");
       },
       unhighlight: function (element) {
           $(element).removeClass("border-red-500");
       },
   });
