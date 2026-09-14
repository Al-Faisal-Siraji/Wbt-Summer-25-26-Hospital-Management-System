# MVC migration guide

The project uses one front controller (`router.php`). It loads `config/config.php`, shared helpers, models, and the selected role controller.

- **Models** contain each screen's SQL queries and database-processing logic.
- **Controllers** read request data, check permissions, call models, and choose a view.
- **Views** render HTML only.

Views are organized by role in `views/auth`, `views/admin`, `views/doctor`, `views/patient`, and `views/receptionist`. SQL statements have been moved to matching role model files.
