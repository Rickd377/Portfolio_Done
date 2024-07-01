<?php
//
class userEditView
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function showView()
    {

        $this->user->getName();
        $this->user->getPassword();
        $this->user->getEmail();
        $this->user->getPhone();
        $this->user->getHouseNumber();

        $htmlString = "";
        

        echo $htmlString;
    }
}