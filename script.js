function sendMail(){
    let parms = {
        name : document.getElementById("name").value,
        email : document.getElementById("email").value,
        subject : document.getElementById("subject").value,
        message : document.getElementById("message").value,  
    }

    email.send("service_b20vo7e","template_06n0209",parms).then(alert("Email Sent!!"))
}