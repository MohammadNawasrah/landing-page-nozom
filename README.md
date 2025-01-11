# Add Provider To App 
Nozom\LandingPagePackage\LandingPageServiceProvider::class,

# Then clear Cache and Route 
php artisan route:clear
php artisan cache:clear
php artisan route:cache

php artisan vendor:publish --provider="Nozom\LandingPagePackage\LandingPageServiceProvider"