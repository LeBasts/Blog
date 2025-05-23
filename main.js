function ajouterPost(){
    divPost = document.getElementById('post');
    buttonPost = document.getElementById('buttonPost');
    divPost.removeChild(buttonPost);
    formPost = document.createElement('form');
    formPost.setAttribute('action','');
    formPost.setAttribute('method','post');
    inputPost = document.createElement('input');
    inputPost.setAttribute('placeholder','Votre texte');
    inputPost.setAttribute('id','postarea');
    inputPost.setAttribute('name','inputPost');
    sendButton = document.createElement('input');
    //sendButton.setAttribute('href','addPost.php');
    sendButton.setAttribute('type','submit');
    sendButton.setAttribute('name','submit');
//    sendButton.setAttribute('class','send');
    sendButton.value = 'Envoyer';
    divPost.style.backgroundColor = 'pink';
    //buttonPost.removeAttribute('onclick');
    divPost.appendChild(formPost);
    formPost.appendChild(inputPost);
    formPost.appendChild(sendButton);
}