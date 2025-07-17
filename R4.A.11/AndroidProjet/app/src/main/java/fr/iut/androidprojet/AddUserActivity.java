package fr.iut.androidprojet;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import fr.iut.androidprojet.db.DatabaseClient;
import fr.iut.androidprojet.db.User;

public class AddUserActivity extends MotherActivity {
    //DATA
    private DatabaseClient mDb;
    //VIEW
    private EditText firstNameView;
    private EditText lastNameView;
    private Button saveBtn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_user);
        // Récupération du DatabaseClient
        mDb = DatabaseClient.getInstance(getApplicationContext());

        firstNameView = findViewById(R.id.editText_firstName);
        lastNameView = findViewById(R.id.editText_lastName);
        saveBtn = findViewById(R.id.button_save);

        saveBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent menuActivityIntent = new Intent(AddUserActivity.this, MenuActivity.class);
                saveUser();
                startActivity(menuActivityIntent);
            }
        });
    }

    private void saveUser(){
        class SaveUser extends AsyncTask<Void, Void, User>{
            @Override
            protected User doInBackground(Void... voids) {
                final String firstName = firstNameView.getText().toString().trim();
                final String lastName = lastNameView.getText().toString().trim();

                // creating a user
                User user = new User();
                user.setFirstName(firstName);
                user.setLastName(lastName);

                // adding to database
                long id = mDb.getAppDatabase().userDao().insert(user);

                // mettre à jour l'id du user
                // Nécessaire si on souhaite avoir accès à l'id plus tard dans l'activité
                user.setId(id);

                return user;
            }

            @Override
            protected void onPostExecute(User user){
                super.onPostExecute(user);
                // Quand la tache est créée, on arrête l'activité AddTaskActivity (on l'enleve de la pile d'activités)
                setResult(RESULT_OK);
                finish();
                Toast.makeText(getApplicationContext(), "Votre compte a bien été crée" , Toast.LENGTH_LONG).show();
            }
        }
        // Penser à executer la demande asynchrone
        SaveUser su = new SaveUser();
        su.execute();
    }

}