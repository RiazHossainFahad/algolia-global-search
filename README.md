## Global search using Algolia.

`Server Requirements:` <br>
`PHP: `Php server & CLI version >= 7.4 <br>

### Please follow the instructions

`step 1:` clone this git repository <br>
`step 2:` copy .env.example to .env <br>
`step 3:` Configure DB info & Algolia id & secret in .env <br>
`step 4:` run command <code>composer install</code> <br>
`step 5:` run command <code>php artisan migrate --seed</code><br>
`step 6:` run command <code>php artisan key:generate</code> <br>
`step 7:` run command <code>php artisan scout:import "App\Models\User"</code> <br>
`step 7:` run command <code>php artisan scout:import "App\Models\Company"</code> <br>
`step 7:` run command <code>php artisan scout:import "App\Models\Project"</code> <br>

### Regards [MD. Riaz Hossain Fahad](https://github.com/RiazHossainFahad)