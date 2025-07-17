package fr.iut.androidprojet.db;

import androidx.room.Dao;
import androidx.room.Delete;
import androidx.room.Insert;
import androidx.room.Query;
import androidx.room.Update;

import java.util.List;

@Dao
public interface UserDao {
    @Query("SELECT * FROM users")
    List<User> getAll();
    @Query("SELECT COUNT(*) FROM users")
    int count();
    @Query("SELECT * FROM users WHERE id = :userId LIMIT 1")
    User retrieveById(long userId);
    @Query("SELECT * FROM users WHERE id IN (:userIds)")
    List<User> retrieveAllByIds(long [] userIds);
    @Query("SELECT * FROM users WHERE first_name LIKE :firstName AND last_name LIKE :lastName LIMIT 1")
    User findByName(String firstName, String lastName);
    @Query("SELECT * FROM users WHERE first_name = :firstName ")
    List<User> findByFirstName(String firstName);
    @Insert
    long insert(User user);
    @Insert
    long [] insertAll(User... users);
    @Update
    void update(User user);
    @Delete
    void delete(User user);
}
