<nav id="upper-section" class="navbar navbar-expand-lg shadow">
  <div class="container-fluid">
    <a class="title navbar-brand" href="../index.html">
      <h1>
        BuzzIT
        <span style="color: #DAA520;">Teleco.</span>
      </h1>
    </a>
    <button id="navbarToggler" class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navigation collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if (isset($_SESSION['user'])): ?>
          <a class="nav-link" aria-current="page" href="../M01/home.php">Home</a>
        <li class="nav-item">
          <a class="nav-link" href="#find">Feeds</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#find">Messages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#find">Friends</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#find">Profile</a>
        </li>
        <?php else: ?>
          <a class="nav-link" href="#" onclick="showLoginMessage(event)">Home</a>
          <li class="nav-item">
          <a class="nav-link" href="#find" onclick="showLoginMessage(event)">Feeds</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#find" onclick="showLoginMessage(event)">Messages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#find" onclick="showLoginMessage(event)">Friends</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#find" onclick="showLoginMessage(event)">Profile</a>
        </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['user'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="../M01/logout.php">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>




<style>
  /*For removing the default link style*/
  a,
  .accordion-body a {
    text-decoration: none;
    color: inherit
  }

  a:focus,
  a:active {
    outline: none
  }



  /*Navigation Bar*/
  #upper-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    background: linear-gradient(45deg, rgb(10 10 10 / .7), rgb(45 45 45 / .7), rgb(89 89 89 / .7));
    backdrop-filter: blur(10px);
    box-shadow: 0px 0px 0px 3px rgb(100 100 100 / .7);
    flex-wrap: wrap;
  }

  .title h1 {
    margin: 0;
    font-size: 40px;
    font-weight: regular;
    font-family: Alumni Sans Inline One;
    color: #FFF
  }

  .navigation {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: center;
    overflow: hidden;
    max-width: 100%
  }

  .navigation .nav-link {
    flex: 1 1 0%;
    padding: 6px 8px;
    font-size: 16px;
    font-family: Roboto;
    cursor: pointer;
    background-color: #fff0;
    color: #E0E0E0;
    border: none;
    border-radius: 10px;
    transition: background-color 0.3s ease
  }

  .navigation .nav-link:hover {
    background-color: #101031;
    box-shadow: 0 4px 10px rgb(0 0 0 / .3);
    transform: translateY(-2px)
  }
</style>