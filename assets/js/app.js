

// DUE DETTE JS ON 
{
    const inputDateDue =document.querySelector('#date-due');
    if(inputDateDue){
        inputDateDue.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,inputDateDue);
        })
    }    
    
    const inputClient =document.querySelector('#client');
    if(inputClient){
        inputClient.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,inputClient);
        })
    }   
    
    const inputProduitDette =document.querySelector('#produit_Dette');
    if(inputProduitDette){
        inputProduitDette.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,inputProduitDette);
        })
    }
}
// DUE DETTE JS OFF

// FRAIS JS ON 
{
    const inputDateFrais =document.querySelector('#date-frais');
    if(inputDateFrais){
        inputDateFrais.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,inputDateFrais);
        })
    }   
    
    const selectFraisFiltre =document.querySelector('#dateJr-frais');
    if(selectFraisFiltre){
        selectFraisFiltre.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,selectFraisFiltre);
        })
    }   
}
// FRAIS JS OFF

// USERS JS ON 
{
    const inputUser =document.querySelector('#user');
    if(inputUser){
        inputUser.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,inputUser);
        })
    }   
}
// USERS JS OFF

// PRODUITS JS ON 
{
    const inputProduit =document.querySelector('#produit');
    if(inputProduit){
        inputProduit.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,inputProduit);
        })
    }   

    const selectFiltreProduit =document.querySelector('#select-filtre-Produit');
    if(selectFiltreProduit){
        selectFiltreProduit.addEventListener("change",(event)=>{
            SelectFiltreAsynchrone(event,selectFiltreProduit);
        })
    }
}
// PRODUITS JS OFF

// VENTE COMMANDE JS ON 
{
    const inputVente =document.querySelector('#date-vente');
    if(inputVente){
        inputVente.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,inputVente);
        })
    }
    const inputClientVente =document.querySelector('#client_vente');
    if(inputClientVente){
        inputClientVente.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,inputClientVente);
        })
    }
    const inputUsertVente =document.querySelector('#user_vente');
    if(inputUsertVente){
        inputUsertVente.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,inputUsertVente);
        })
    }
}
// VENTE COMMANDE JS OFF

// CAISSE JS ON 
{
    const inputCaisse =document.querySelector('#date_caisse');
    if(inputCaisse){
        inputCaisse.addEventListener("change",(event)=>{
            inputFiltreAsynchrone(event,inputCaisse);
        })
    }
}
// CAISSE JS OFF

// POINT JS ON 
{
    const selectPoint = document.querySelector('#selectPoint');
    if(selectPoint){
        selectPoint.addEventListener("change",(event)=>{
            SelectFiltreAsynchrone(event,selectPoint);
        })
    }
}
// POINT JS ON 

// FORMULAIRE DE PRODUITS JS ON 
{
    const inputPrixAchat = document.querySelector('.prixAchatInput');
    const inputPrixVenteMin = document.querySelector('.prixVenteMinInput');
    console.log(inputPrixAchat)
    if(inputPrixAchat){
        inputPrixAchat.addEventListener('keyup',() =>{
                inputPrixVenteMin.value = parseFloat(inputPrixAchat.value) + parseFloat(inputPrixAchat.value * 20 / 100);
            }
        )
    }
}
// FORMULAIRE DE PRODUITS JS ON 

function SelectFiltreAsynchrone(event,select){
    const option=event.target.options[select.selectedIndex];
    const path=option.getAttribute('data-path')  
    fetch(path,{
    method: 'GET',
    headers: {
    'Content-Type': 'application/json'
    }
    }).then(response => response.json())
    .then(url => {
        window.location.href=url;
    })
    .catch(err => console.log(err))
}

function inputFiltreAsynchrone(event,input){
    const path = `${input.getAttribute('data-path')}?attr${input.id}=${input.value}`       
    fetch(path,{
        method: 'GET',
        headers: {
        'Content-Type': 'application/json'
        }
        }).then(response => response.json())
        .then(url => {
        window.location.href=url;
        })
        .catch(err => console.log(err))  
}

// PRINT JS ON 
{
    pExist = document.querySelector(".imprimer")
    if (pExist) {
        window.print()
    }
}
// PRINT JS OFF
