class validateForm{
    constructor(registerForm){
        this.form = document.getElementById(registerForm);
        if(this.form===null){
            console.log("not found");
        }
        this.inputs = [...this.form.querySelectorAll('input')];
    }
    addInputListeners() {
        this.inputs.forEach((input) => {
          input.addEventListener('keyup', () => {
            this.validateInput(input);
          });
        });
    }
    validateInput(input) {
        const id = input.getAttribute('id');
        const value = input.value.trim();
        console.log("in validate input");
        switch (id) {
            case 'Username':
                const usernameRegex = /^[a-zA-Z0-9]{4,10}$/;
                if(!usernameRegex.test(value) && value!==''){
                    this.showError(input, 'Username must be alphanumeric and have 4 to 10 characters');
                    return false;
                }
                break;
            case 'name':
                const nameRegex = /^[a-zA-Z\s']+$/;
                if(!nameRegex.test(value) && value!==''){
                    this.showError(input, 'Name must contain only alphabets and spaces');
                    return false;
                }
                break;
            case 'Phone':
                const phoneRegex = /^(?:\+91|0)?[6789]\d{9}$/;
                if(!phoneRegex.test(value) && value!==''){
                    this.showError(input, 'Please enter a valid phone number');
                    return false;
                }
                break;
            case 'password':
                const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])\S{4,20}$/;
                if(!passwordRegex.test(value) && value!==''){
                    this.showError(input, 'Password must contain atleast one alphabet, one digit and one special character');
                    return false;
                }
                break;
            case 'email':
                const emailRegex = /^\S+@\S+\.\S+$/;
                if(!emailRegex.test(value) && value!==''){
                    this.showError(input, 'Please enter a valid email address');
                    return false;
                }
                break;
            case 'confirmPassword':
                if(value!==document.getElementById('password').value && value!==''){
                    this.showError(input,'Password Confirmation does not match')
                    return false;
                }
            default:
              break;
        }
        console.log("true");
        this.clearError(input);
        return true;
    }
    static showChangesalert(formid,buttonid){
        var btn = document.getElementById(buttonid);
        var form = document.getElementById(formid); 
        btn.addEventListener('click',(e)=>{
            e.preventDefault();
            Swal.fire({
                title: 'Changes saved!',
                text: 'Your changes have been saved successfully.',
                icon: 'success',
                confirmButtonText: 'OK',
                    
            }).then(()=>{
                form.submit();
            });
        });
    }
    showError(input,message){
        var err = input.nextElementSibling;
        err.innerHTML = message;
        err.style.display = 'block';
        err.classList.add('invalid-feedback');
    }
    clearError(input){
        var err = input.nextElementSibling;
        err.innerHTML = ``;
        err.style.display = 'none';
        err.classList.remove('invalid-feedback');
        console.log("in clear");
    }
}

