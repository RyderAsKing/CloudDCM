### TODO

-   [x] Move function for rack spaces (colocation_manager.racks.spaces.move)
-   [ ] Delete confirmation modal on delete requests (colocation_manager.racks.spaces.destroy)
-   [x] VPS manager database migrations, models, factories
-   [x] Desktop navbar revamp
-   [ ] Mobile navbar revamp
-   [x] UI Update (spacing and sizing)
-   [x] UI update (links and buttons)

### For future update

change LocationPolicy and make it a root policy instead of Colocation_Manager sub policy.
pass an additional attribute to LocationPolicy "for" which determines whether its vps manager or colocation manager (eg. colocation/vps)
perform a check by checking of the user has roles
