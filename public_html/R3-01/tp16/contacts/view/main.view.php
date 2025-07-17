<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Contacts</title>
  <link rel="stylesheet" type="text/css" href="public/design/style.css">
  <link rel="icon" type="image/png" href="public/design/img/contacts_32.png" />
</head>

<body>
  <header>
    <h1><img src="public/design/img/contacts_60.png" alt="Icon contact"> Contacts
      <form>
        <input type="text" placeholder="Rechercher">
        <button type="submit" disabled style="display: none" aria-hidden="true"></button>
      </form>
    </h1>
  </header>
  <main>
    <table>
      <thead>
        <tr>
          <th>Prenom</th>
          <th>Nom</th>
          <th>Mobile</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </main>
  <!-- Template d'une ligne à recopier dans le tableau -->
  <template id="rowTemplate">
    <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </template>
  <script type="module" src="public/js/controller.js"></script>
</body>

</html>