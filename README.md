# Symfony 6.4 project (started with on [the official doc](https://symfony.com/doc/6.4/setup.html))

## The only purpose is to demonstrate the problem with the `custom_authenticators` setting in the firewall

---

To run the project you need :
```
- php 8.1 (or higher)
- composer
```

Installation - Running steps :  
```
- clone the project
- cd into it
- run composer install
- run php bin/console doc:sch:create ?
- run php bin/console doc:fix:load ?
- run symfony server:start
```

What I what to achieve is :
- when an anonymous user access / => display the page
- when a logged-in user try to access / , he should be redirected.
This means I need to know if he's logged in (so an exception in the firewall is not a solution)

This is why an access_control has been set in the `config/security.yml` file :
```
access_control:
- { path: ^/$, roles: PUBLIC_ACCESS }
```
This works fine when setting `form_login` instead of `the custom_authenticators` 

It seems like :  
In the `custom_authenticators` does not take the `access_control` rules.  
This means access to the homepage '/' can not be done anonymously.

I can not find the option or param in the firewall to do so.  
Does it come from the App\Security\CustomAuthenticator file and the `supports()` function ?
