<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Contacts</title>
  <meta name="author" content="Jean-Pierre Chevallet" />
  <link rel="stylesheet" type="text/css" href="../view/design/style.css">
</head>

<body>
  <header>
    <h1>
      <a href="main.ctrl.php">
      <img src="../view/design/img/contacts_60.png" alt="Icon contact"> Contacts
      </a>
      <form action="search.ctrl.php">
        <input type="text" placeholder="Rechercher" name="pattern" value="<?=$pattern?>">
      </form>
    </h1>
  </header>
  <main>
    <aside>
      <form action="create.ctrl.php">
        <button>Ajouter un contact</button>
      </form>
    </aside>
      <table>
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mobile</th>
            <th class="delete"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($contacts as $contact): ?>
          <tr>
            <td>
            <form action="update.ctrl.php">
              <input type="hidden" name="id"  value="<?= $contact->getId() ?>">
              <input type="text" name="nom"  value="<?=$contact->getNom()?>">
            </form>
            </td>
            <td>
            <form action="update.ctrl.php">
              <input type="hidden" name="id"  value="<?=$contact->getId()?>">
              <input type="text" name="prenom"  value="<?=$contact->getPrenom()?>">
            </form>
            </td>
            <td>
            <form action="update.ctrl.php">
              <input type="hidden" name="id"  value="<?=$contact->getId()?>">
              <input type="text" name="mobile"  value="<?=$contact->getMobile()?>">
            </form>
            </td>
            <td class="delete">
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </main>
  <script src="../js/view.js"></script>
  <script src="../js/model/dao.js"></script>
  <script src="../js/model/contact.js"></script>
  <script src="../js/controler.js"></script>
</body>

</html>