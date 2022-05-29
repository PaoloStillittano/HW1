function LoadPost(){
    fetch("carica_post.php").then(OnResponsePost).then(OnJsonPost);
}

function OnResponsePost(response){
    return response.json();
}

function OnJsonPost(json){
    const gallery=document.querySelector('.posts');
    gallery.innerHTML="";
    for(let i = 0; i < json.length; i++){
        const block=document.createElement('div');
        block.classList.add('cell');

        const titolo=document.createElement('span');
        titolo.textContent=json[i].titolo;
        titolo.classList.add('titolo');

        const description=document.createElement('div');
        description.classList.add('descrizione');

        const descrizione=document.createElement('span');
        descrizione.textContent=json[i].descrizione;

        const img=document.createElement('img');
        img.src=json[i].immagine;
        img.classList.add('imgPost');

        const buttons=document.createElement('div');
        buttons.classList.add('button');

        const divlike=document.createElement('div');
        divlike.classList.add('divlike');

        const like=document.createElement('img');
        console.log(json[i].liked);
        if(json[i].liked === '0'){
            console.log("tolgo");
            like.src="images/unliked.svg";
            like.addEventListener('click',likePost);
        }
        else{
            console.log("metto");
            like.src="images/liked.svg";
            like.addEventListener('click',unlikePost);
        }
        like.classList.add('like');

        const num_like=document.createElement('span');
        num_like.textContent=json[i].nlikes;

        block.appendChild(titolo);

        description.appendChild(img);
        description.appendChild(descrizione);
        block.appendChild(description);

        divlike.appendChild(like);
        divlike.appendChild(num_like);
        buttons.appendChild(divlike);
        block.appendChild(buttons);
        gallery.appendChild(block);
    }
}

function likePost(event){
    let like=event.currentTarget;
    const box=like.parentNode.parentNode.parentNode;
    const nome=box.querySelector('span.titolo').textContent;
    fetch("likesTrigger.php?titolo=" + nome);
    like.src="images/liked.svg";
    //LoadPost();
}

function unlikePost(event){
    let like=event.currentTarget;
    const box=like.parentNode.parentNode.parentNode;
    const nome=box.querySelector('span.titolo').textContent;
    fetch("unlikesTrigger.php?titolo=" + nome);
    like.src="images/unliked.svg";
    //LoadPost();
}

LoadPost();
