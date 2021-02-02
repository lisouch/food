const users = document.getElementById('user');

if(user){
    user.addEventListener('click', (e) => {
        if(e.target.className === "btn btn-outline-danger btn-lg delete-user"){
            if(confirm("Etes-vous sûr de vouloir supprimer votre profil?")){
                const id = e.target.getAttribute('id');

                fetch(`/user/delete/${id}`,{
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}