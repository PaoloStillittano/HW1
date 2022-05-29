function SearchSong(event){
    event.preventDefault();
   
    const titolo=spotify.querySelector('#song').value;
    fetch("spotify.php?track=" + encodeURIComponent(titolo)).then(onResponseSong).then(onJsonSong);
}

function onResponseSong(response){
    return response.json();
}

function onJsonSong(json){
    const library=document.querySelector("#view");
    library.innerHTML=''; 
    let results=json.tracks.total;

    if(results>4){
        results=4;
    }

    for(let i=0; i<results ; i++){
        const result=json.tracks.items[i];
        const title=result.name;
        const artista=result.artists[0].name;
        const img_album=result.album.images[0].url;

        const track=document.createElement('div');
        track.classList.add('track');
        const img=document.createElement('img');
        img.src=img_album;
        const titolo=document.createElement('h2');
        titolo.textContent=title;
        const cantante=document.createElement('h3');
        cantante.textContent=artista;

        const player=document.createElement('iframe');
        player.src = "https://open.spotify.com/embed/track/"+result.id;
        
        player.setAttribute('allowtransparency', 'true');
        player.allow = "encrypted-media";
        player.classList = "player";

        track.appendChild(titolo);
        track.appendChild(cantante);
        track.appendChild(player);
        library.appendChild(track);
    }
}

const spotify=document.querySelector('#Spotify');
spotify.addEventListener('submit',SearchSong);

console.log("ci sono");
