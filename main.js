function ajouterPost(){
    let divPost = document.getElementById('post');
    let buttonPost = document.getElementById('buttonPost');
    divPost.removeChild(buttonPost);
    let formPost = document.createElement('form');
    formPost.setAttribute('action','');
    formPost.setAttribute('method','post');
    let inputPost = document.createElement('input');
    inputPost.setAttribute('placeholder','Votre texte');
    inputPost.setAttribute('id','postarea');
    inputPost.setAttribute('name','inputPost');
    let sendButton = document.createElement('input');
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
function modify(id){
    let parent = document.getElementById(id).parentNode;
    let form = document.createElement('form');
    form.setAttribute('action','');
    form.setAttribute('method','post');
    parent.appendChild(form);
    //parent.insertBefore(form, parent.firstChild);
    document.getElementById(id).parentNode.style.backgroundColor = 'green';
    console.log("parent : "+parent.firstChild.innerText);
    let post = parent.firstChild.innerText;
    parent.firstChild.remove();
    let input = document.createElement('input');
    input.setAttribute('name','newPost');
    input.setAttribute('type','text');
    form.appendChild(input);
    input.value = post;
    input.focus();
    input.setSelectionRange(post.length, post.length);
    previousPost = document.createElement('input');
    previousPost.innerText = post;
    previousPost.value = post;
    previousPost.setAttribute('name','previousPost');
    previousPost.setAttribute('id','previousPost');
    form.appendChild(previousPost);
    
    button = document.createElement('input');
    button.setAttribute('type','submit');
    form.appendChild(button);
}