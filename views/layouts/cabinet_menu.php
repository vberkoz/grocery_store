<aside class="col-md-3">
    <div class="list-group">
        <a href="/cabinet/history" class="list-group-item list-group-item-action <?php if ($_SERVER['REQUEST_URI'] == '/cabinet/history') echo 'active'; ?>">My order history</a>
        <a href="/cabinet/edit" class="list-group-item list-group-item-action <?php if ($_SERVER['REQUEST_URI'] == '/cabinet/edit') echo 'active'; ?>">Settings</a>
    </div>
    <a class="btn btn-outline-secondary btn-block mt-2" href="/signout">
        Sign Out
    </a>
</aside>