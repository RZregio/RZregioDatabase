<nav id="upper-section" class="navbar navbar-expand-lg shadow">
  <div class="container-fluid">
    <a class="title navbar-brand" href="../index.html">
      <h1>
        Among
        <span style="color: #CCCE31;">Flight.</span>
      </h1>
    </a>
  </div>
</nav>




<style>
  /*For removing the default link style*/
  a,
  {
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
    background: #880000;
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
</style>