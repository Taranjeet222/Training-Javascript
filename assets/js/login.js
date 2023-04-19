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
                <div class="card-body">
                    <h4 class="card-title">Password Recovery</h4>
                    <form>
                        <div class="form-group">
                            <label for="Username">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Send me Password">
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
}
const forgot = new forgotPassword();
