<!-- Partie d'une vue : le menu -->
<nav>
  <form method="get">
    <input type="hidden" name="ctrl" value="menu">
    <ul>
      <li>
        Acces
        <ul>
          <li>
            <button type="submit" name="viewName" value="login">Login</button>
          </li>
          <li>
            <button type="submit" name="viewName" value="logout">Logout</button>
          </li>
        </ul>
      </li>
      <li>
        Les Articles
        <ul>
          <li>
            <button type="submit" name="viewName" value="article.read">Acceder</button>
          </li>
          <li>
            <button type="submit" name="viewName" value="article.update">Modifier</button>
          </li>
          <li>
            <button type="submit" name="viewName" value="article.delete">Supprimer</button>
          </li>
          <li>
            <button type="submit" name="viewName" value="article.create">Ajouter</button>
          </li>
        </ul>
  </form>
  </li>
  </ul>
</nav>