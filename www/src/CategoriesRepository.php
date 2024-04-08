<?php

class CategoriesRepository
{
  private PDO $connection;
  public function __construct(
    private Database $database
  ) {
    $this->connection = $this->database->getConnection();
  }

  public function getCategories(): array
  {
    $stmt = $this->connection->prepare('SELECT * FROM categories');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getCategory(int $id): array
  {
    $stmt = $this->connection->prepare('SELECT * FROM categories WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function createCategory(array $data): array
  {
    $stmt = $this->connection->prepare('INSERT INTO categories (name, parent_id) VALUES (:name, :parent_id)');
    $stmt->execute(['name' => $data['name'], 'parent_id' => $data['parent_id'] ?? null]);
    return $this->getCategory((int)$this->connection->lastInsertId());
  }

  public function updateCategory(int $id, array $data): array
  {
    $fields = '';
    foreach ($data as $key => $value) {
      $fields .= $key . ' = :' . $key . ', ';
    }
    $fields = rtrim($fields, ', ');

    $stmt = $this->connection->prepare('UPDATE categories SET ' . $fields . ' WHERE id = :id');
    $data['id'] = $id;
    $stmt->execute($data);
    return $this->getCategory($id);
  }

  public function deleteCategory(int $id): array
  {
    $category = $this->getCategory($id);
    $stmt = $this->connection->prepare('DELETE FROM categories WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $category;
  }
}
