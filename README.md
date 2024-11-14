**HRTool** is an HR management application built using the Laravel framework, offering a centralized platform to manage employee data, contracts, positions, roles, and permissions.

**Technologies Used**
Programming Languages: The application is built with JavaScript for dynamic front-end behavior, PHP for backend functionality, HTML for page structure, and CSS for styling and layout. Together, these languages provide a seamless, responsive, and engaging user experience.
Blade Templating Engine: Laravel’s Blade templating engine is used to render the front-end views efficiently. Blade allows for easy integration of PHP code within HTML, promoting modular, reusable components and enabling the development of dynamic, interactive interfaces with minimal code duplication.
Laravel Framework: This application is developed using the Laravel framework, which provides robust backend capabilities, handles server-side logic, and offers a secure, efficient foundation for building and maintaining complex web applications. Laravel's extensive libraries, routing capabilities, and MVC architecture streamline development and ensure maintainable code.
Database Management: Data is managed through Laravel’s migration system, which simplifies database version control, schema management, and data seeding. This approach allows for seamless database modifications and keeps database changes consistent across development environments, enhancing collaboration and stability throughout the development lifecycle.

**Key Features**
Admin Panel: Enables management of various aspects of the application, including data and user roles.
Roles and Permissions: Fine-grained access control allowing different levels of access for various user roles, with three primary roles:
_IT Department:_ Has access to all application features except employee documents.
_HR Department:_ Can access all employee documents and employee requests.
_Other Employees:_ Limited access, with visibility only to their own documents.
The application also allows users to view the company's departments, see who manages each department, and identify which employees work in each department. Adding new employees is simplified, as the application allows for the generation, editing, and printing of employee documents with a single click.
Messages: Added as notifications within the application to improve clarity around operations, enhancing communication and transparency.
Contracts & Positions: Modules for creating, viewing, printing, and managing employee contracts and job positions. This includes automated contract generation for easy handling of employee documents, as well as efficient management of company positions and their relationships.
Annex Management: Allows for easy printing and updating of contract annex documents. Modules support adding employment contracts, other agreements, leave certifications, and similar documents.
Family Members: Enables tracking of family member information (spouses and children) associated with employees. This feature supports healthcare benefits, holiday gifts, and other family-related employee benefits.
