## About Projects

Aplikasi ini dibuat berbasis website yang diberi nama Cari cari

### Built With

- [Bootstrap](https://getbootstrap.com/)
- [XAMPP](https://www.apachefriends.org/download.html)
- [Apache Jena Fuseki](https://jena.apache.org/documentation/fuseki2/index.html)

## Requirements

<ul>
    <li>Git</li>
    <li>Composer</li>
    <li>XAMPP</li>
    <li>PHP 8.0</li>
    <li>Browser</li>
    <li>Apache Jena Fuseki</li>
</ul>

## Installation

1. Siapkan dan instal semua Persyaratan
2. Clone proyek di folder XAMPP (../xampp/htdocs)
   ```sh
       git clone https://github.com/Syaiful-Maulana/tugas
   ```
3. Jalankan Apache Jena Fuseki di root folder
   ```sh
       fuseki-server --update --mem /ds
   ```
4. Tambahkan file turtle di `/src/sparql/universitas.owl` ke Apache Jena Fuseki di http://localhost:3030/
5. Jalankan aplikasi

## Author

| NIM       | Name                     |
| --------- | ------------------------ |
| 201951243 | Muhammad Syaiful Maulana |
