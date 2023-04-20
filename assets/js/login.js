class forgotPassword{
    constructor(){
        this.clicked = false;
    }
    addForm(){
        var passwordLink = document.getElementById("forgot-password-link");
        passwordLink.addEventListener('click',(e)=>{
            e.preventDefault();
            var infoForm = document.createElement("div");
            infoForm.classList.add("card");
            infoForm.classList.add("text-center");
            infoForm.setAttribute("id", "forgot-form");
            infoForm.innerHTML = `
                <div class="card-body bg-secondary bg-gradient">
                    <h4 class="card-title">Password Recovery</h4>
                    <form id="reset-password-form">
                        <div class="form-group">
                            <label for="Username">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <input type="submit" class="btn btn-primary" style="margin-top:10px;" value="Send me Password">
                    </form>
                </div>
            `;
            if(this.clicked===false)
            {
                document.body.appendChild(infoForm);
                this.clicked = true;
                var firstForm = document.getElementById("FirstForm");
                firstForm.style.display = 'none';
            }
        });
    }
    sendEmail(){
        $(document).ready(function(){
            $('#reset-password-form').submit(function(event){
              event.preventDefault(); 
              var email = $('#email').val();
              $.ajax({
                url: '/ajax/send-password/',
                method: 'POST',
                data: { email: email },
                success: function(response){
                  if (response.status === 'success') {
                    alert('An email has been sent to you at ' + email + '. Kindly check the email.');
                  } else if (response.status === 'not_found') {
                    alert('Email address not found. Please enter a valid email address.');
                  } else {
                    alert('An error occurred while sending the email. Please try again later.');
                  }
                },
                error: function(){
                  alert('An error occurred while sending the email. Please try again later.');
                }
              });
            });
        });
    }
}
const forgot = new forgotPassword();
