class register{
    handleSubmit(event) {
        event.preventDefault();
        window.location.assign("../index.php");
    }
}
const reg_page = new register();
console.log("now");