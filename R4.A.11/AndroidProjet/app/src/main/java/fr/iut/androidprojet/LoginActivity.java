package fr.iut.androidprojet;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import fr.iut.androidprojet.db.DatabaseClient;
import fr.iut.androidprojet.db.User;

public class LoginActivity extends MotherActivity {
    //DATA
    private DatabaseClient mDb;
    //VIEW
    private EditText firstNameView;
    private EditText lastNameView;
    private Button connectBtn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        // Récupération du DatabaseClient
        mDb = DatabaseClient.getInstance(getApplicationContext());

        firstNameView = findViewById(R.id.editText_firstName);
        lastNameView = findViewById(R.id.editText_lastName);
        connectBtn = findViewById(R.id.button_connect);

        connectBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Récupérer les valeurs des champs de texte
                String firstName = firstNameView.getText().toString().trim();
                String lastName = lastNameView.getText().toString().trim();

                // Vérifier si les champs sont vides
                if (firstName.isEmpty() || lastName.isEmpty()) {
                    Toast.makeText(LoginActivity.this, "Veuillez remplir tous les champs.", Toast.LENGTH_SHORT).show();
                } else {
                    // Vérifier si l'utilisateur existe dans la base de données
                    checkUserCredentials(firstName, lastName);
                }
            }

            private void checkUserCredentials(String firstName, String lastName) {
                // Classe asynchrone permettant de vérifier si l'utilisateur existe dans la base
                class CheckUser extends AsyncTask<Void, Void, User> {
                    @Override
                    protected User doInBackground(Void... voids) {
                        // Récupérer l'utilisateur de la base de données
                        return mDb.getAppDatabase().userDao().findByName(firstName, lastName);
                    }

                    @Override
                    protected void onPostExecute(User user) {
                        super.onPostExecute(user);

                        // Vérifier si l'utilisateur existe
                        if (user != null) {
                            // Connexion réussie
                            Toast.makeText(LoginActivity.this, "Bienvenue, " + user.getFirstName() + "!", Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent(LoginActivity.this, MenuActivity.class);
                            startActivity(intent);
                            finish();
                        } else {
                            // Utilisateur non trouvé
                            Toast.makeText(LoginActivity.this, "Utilisateur non trouvé.", Toast.LENGTH_SHORT).show();
                        }
                    }
                }
                // Exécuter la tâche asynchrone
                new CheckUser().execute();
            }
        });

    }
}