require('./bootstrap');

require('alpinejs');

import Swal from "sweetalert2";

window.deleteConfirm = function(formId){
    Swal.fire({
        title: 'Attention !',
        text: "Etes-vous sure de vouloir supprimer ce produit?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, Supprimer!',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById(formId).submit();
        }
      })
}
