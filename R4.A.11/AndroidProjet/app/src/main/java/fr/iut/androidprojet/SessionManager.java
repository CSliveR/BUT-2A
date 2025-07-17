package fr.iut.androidprojet;

import android.content.Context;
import android.content.SharedPreferences;
public class SessionManager {
    private SharedPreferences sharedPreferences;
    private SharedPreferences.Editor editor;
    private Context context;

    private static final String PREF_NAME = "userSession";
    private static final String KEY_USER_ID = "userId";

    public SessionManager(Context context) {
        this.context = context;
        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        editor = sharedPreferences.edit();
    }

    // Enregistrer l'ID de l'utilisateur dans la session
    public void setCurrentUserId(long userId) {
        editor.putLong(KEY_USER_ID, userId);
        editor.apply();
    }

    // Récupérer l'ID de l'utilisateur actuel
    public long getCurrentUserId() {
        return sharedPreferences.getLong(KEY_USER_ID, -1);  // -1 signifie que l'utilisateur n'est pas connecté
    }

    // Vérifier si l'utilisateur est connecté
    public boolean isUserLoggedIn() {
        return getCurrentUserId() != -1;
    }

    // Déconnecter l'utilisateur
    public void logout() {
        editor.remove(KEY_USER_ID);
        editor.apply();
    }
}

