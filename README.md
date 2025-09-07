# 3dmap-kadaster

This project is a simple 3d map viewer using CesiumJs library based on Kadaster 3d data. It was created to show how to use cesium with php, jquery, and ajax to load data from a json file. The project also using cesium's built-in 3dtileset to load data from ion assets.

I hope this project can be useful for you.

### Purpose

- Visualize 3D cadastral data using modern web technologies
- Demonstrate RRR (Rights, Restrictions, Responsibilities) representation in 3D space
- Provide interactive exploration of physical and legal objects in land administration
- Support modern land administration practices through 3D visualization

### Key Concepts

- **Physical Objects**: Real-world structures and boundaries that can be measured and identified
- **Legal Objects**: Legal entities that define rights, obligations, and boundaries related to property ownership
- **RRR System**: Rights, Restrictions, and Responsibilities framework for land administration

---

## Technology Stack

### Frontend Technologies

- **CesiumJS 1.111**: 3D globe and map visualization library
- **Bootstrap 5.2.1**: CSS framework for responsive design
- **jQuery 3.7.1**: JavaScript library for DOM manipulation
- **Cesium Ion & CesiumJs**: 3D tilesets and terrain data

### Backend Technologies

- **PHP 8+**: Server-side scripting language
- **MySQL 8.0**: Database management system
- **Composer**: Dependency management for PHP

### External Services

- **Cesium Ion**: 3D tilesets and terrain data
- **OpenStreetMap**: Base map tiles
- **Bing Maps**: Aerial imagery

### Dependencies (via Composer)

- `ezyang/htmlpurifier`: HTML sanitization
- `ausi/slug-generator`: URL slug generation
- `mpdf/mpdf`: PDF generation

---

## Features & Functionality

### 3D Visualization

- **Interactive 3D Map**: Navigate through 3D representations of buildings
- **Layer Management**: Toggle visibility of different building layers
- **Camera Controls**: Predefined camera positions for key locations
- **Measurement Tools**: Measure distances and areas in 3D space

### Data Visualization

- **Physical Objects**: 3D building models with floor-by-floor visualization
- **Legal Objects**: Overlay of legal boundaries and property rights
- **RRR Information**: Rights, Restrictions, and Responsibilities data

### Building Coverage

1. **Siola Surabaya**: Historic building with mixed-use spaces
2. **Balai Pemuda Surabaya**: Youth center and cultural facility
3. **Rusunawa Buring 2 Malang**: Public housing complex

### Interactive Features

- **Search Functionality**: Find specific rooms or areas
- **Information Panels**: Detailed information about selected objects
- **Layer Controls**: Show/hide different data layers
- **Minimap**: 2D overview map with current view indicator

### Administration Features

- **User Management**: Admin can manage user accounts
- **Data Management**: CRUD operations for all data entities
- **Tenant Management**: Track rental agreements and tenants
- **Document Generation**: PDF generation for certificates and agreements

---

## User Interface Guide

### Main Navigation

- **Layer Panel**: Control visibility of 3D models and legal objects
- **Camera Menu**: Quick navigation to predefined viewpoints
- **Measurement Tools**: Distance and area measurement capabilities
- **Search Bar**: Find specific locations or objects
- **Help System**: FAQ and usage guidance

### Layer Panel Structure

```
Building Layers:
├── Siola
│   ├── Physical Objects (floors 1-5, foundation)
│   └── Legal Objects (units, boundaries, zoning)
├── Balai Pemuda
│   ├── Physical Objects (floors, basement, foundation)
│   └── Legal Objects (spaces, boundaries)
└── Rusunawa
    ├── Physical Objects (floors 1-5)
    └── Legal Objects (residential units, common areas)
```

### Modal Dialogs

- **Room Details**: Comprehensive room information
- **Organizer Details**: Management entity information
- **Tenant Details**: Renter/occupant information
- **RRR Details**: Rights, Restrictions, Responsibilities

## How to use

1. Clone this repository
2. Run composer install
3. Restore database `database.sql`
4. Configure database in `action\db_connect.php`
5. Configure `action\first-load.php`, set base url to your project, `$BASE_URL = "http:localhost:PORT/";`
6. Run local server OR `php -S localhost:8080`

### Cesium Ion Configuration

The project uses Cesium Ion for 3D tilesets. Ensure you have valid access tokens configured in the JavaScript files and data ids for the tilesets (we cannot share our data).

### Code Structure

#### JavaScript Organization

- `cesiumScript.js`: Main Cesium application logic
- `script.js`: General UI interactions
- `cesium-measure-tool.js`: Measurement functionality
- `Cesium3DTileLocationEditor.js`: 3D tile editing tools

#### PHP Organization

- `action/`: Backend API endpoints
- `data/`: Data management interfaces
- `auth/`: Authentication system
- `dashboard/`: Administrative interface

### Coding Standards

- Follow PSR-12 for PHP code
- Use ES6+ features for JavaScript
- Consistent indentation (2 spaces for JS, 4 for PHP)
- Comprehensive commenting for complex logic

---

## Troubleshooting

### Common Issues

#### Database Connection Issues

```
Error: "Database Connection Failed!"
Solution:
1. Check database credentials in db_connect.php
2. Ensure MySQL service is running
3. Verify database exists and is accessible
```

#### 3D Visualization Not Loading

```
Error: Cesium viewer not initializing
Solution:
1. Check browser WebGL support
2. Verify Cesium Ion token validity
3. Check browser console for errors
4. Ensure proper HTTPS for production
```

#### Search Functionality Issues

```
Error: Search returns no results
Solution:
1. Check database data integrity
2. Verify search endpoint accessibility
3. Check for proper URL encoding
```

### Performance Optimization

- Enable browser caching for static assets
- Optimize 3D model complexity
- Use appropriate level-of-detail for large datasets
- Implement progressive loading for complex scenes

### Browser Compatibility

- Chrome 90+ (recommended)
- Firefox 88+
- Safari 14+
- Edge 90+
- Mobile browsers with WebGL support

---

## Contributing

### Development Workflow

1. Fork the repository
2. Create feature branch (`git checkout -b feature/new-feature`)
3. Make changes and test thoroughly
4. Commit changes (`git commit -am 'Add new feature'`)
5. Push to branch (`git push origin feature/new-feature`)
6. Create Pull Request

### Contribution Guidelines

- Follow existing code style and conventions
- Add tests for new functionality
- Update documentation for significant changes
- Ensure backward compatibility
- Test across multiple browsers

### Issue Reporting

- Use GitHub Issues for bug reports
- Provide detailed reproduction steps
- Include browser and system information
- Attach relevant screenshots or logs

---

## Support and Donations

If you find this project useful and would like to support its further development, you can make a donation via the following platforms:

https://ko-fi.com/zakialawi

Every contribution you make is greatly appreciated. Thank you!

- **Documentation**: [Wiki](https://github.com/zakialawi02/starterpack-laravel12/wiki)
- **Issues**: [GitHub Issues](https://github.com/zakialawi02/starterpack-laravel12/issues)
- **Discussions**: [GitHub Discussions](https://github.com/zakialawi02/starterpack-laravel12/discussions)
