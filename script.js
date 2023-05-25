const form = document.querySelector('form');
const citation = document.querySelector('#citation');

form.addEventListener('submit', (event) => {
  event.preventDefault();

  const longueur = form.longueur.value;
  const sujet = form.sujet.value;

  let url = 'https://api.quotable.io/random';

  if (longueur === 'court') {
    url += '?maxLength=50';
  } else if (longueur === 'moyen') {
    url += '?minLength=50&maxLength=100';
  } else if (longueur === 'long') {
    url += '?minLength=100';
  }

  if (sujet) {
    url += `&tags=${sujet}`;
  }

  fetch(url)
    .then(response => response.json())
    .then(data => {
      citation.textContent = `${data.content} — ${data.author}`;
      
      // Envoie la citation générée à la base de données
      const formData = new FormData();
      formData.append('author', data.author);
      formData.append('content', data.content);
      formData.append('sujet', sujet);

      fetch('in/save_citation.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        const citationID = data.id; // Récupère l'ID de la citation insérée
        const citationName = `citation ${citationID}`; // Génère le nom de la citation

        // Envoie la citation avec le nom à la base de données
        const formDataWithName = new FormData();
        formDataWithName.append('author', data.author);
        formDataWithName.append('content', data.content);
        formDataWithName.append('sujet', sujet);
        formDataWithName.append('name', citationName);

        fetch('in/save_citation.php', {
          method: 'POST',
          body: formDataWithName
        })
        .then(response => {
          if (response.ok) {
            console.log('Citation enregistrée avec succès');
          } else {
            console.log('Erreur lors de l\'enregistrement de la citation');
          }
        })
        .catch(error => {
          console.log(error);
        });
      })
      .catch(error => {
        console.log(error);
      });
    })
    .catch(error => {
      console.log(error);
    });
});
