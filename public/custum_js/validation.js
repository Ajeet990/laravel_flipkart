// window.onload = function () {
//     if (window.jquery) {

        $(document).ready(function () {
            $('#loginForm, #adminLoginForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password:{
                        required:true
                    }
                },
                messages: {
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a valid email address'
                    },
                    password:{
                        required:"Please enter password"
                    }
                }
            });
            
            $('#addNewProduct').validate({
                rules: {
                    name: {
                        required: true
                    },
                    cat_name:{
                        required:true
                    },
                    description:{
                        required:true
                    },
                    price:{
                        required:true
                    },
                    product_image:{
                        required:true
                    }
                },
                messages: {
                    email: {
                        required: 'Please enter your email address'
                    },
                    cat_name:{
                        required:"Please select category."
                    },
                    description:{
                        required:"Please enter description."
                    },
                    price:{
                        required:"Please enter price"
                    },
                    product_image:{
                        required:"Image can't be empty"
                    }
                }
            });
        });
//     }
// }