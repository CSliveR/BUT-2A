package fr.iut.androidprojet;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.List;

import fr.iut.androidprojet.db.User;

public class UsersAdapter extends ArrayAdapter<User> {
    public UsersAdapter(Context mCtx, List<User> userList) {
        super(mCtx, R.layout.template_user, userList);
    }
    /**
     * Remplit une ligne de la listView avec les informations de l'utilisateur associé
     * @param position
     * @param convertView
     * @param parent
     * @return
     */
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        // Récupération de l'utilisateur
        final User user = getItem(position);
        // Charge le template XML
        LayoutInflater inflater = (LayoutInflater) getContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        final View rowView = inflater.inflate(R.layout.template_user, parent, false);
        // Récupération des objets graphiques dans le template
        TextView userFirstName = rowView.findViewById(R.id.textView_userFirstName);
        TextView userLastName = rowView.findViewById(R.id.textView_userLastName);
        //
        userFirstName.setText(user.getFirstName());
        userLastName.setText(user.getLastName());
        //
        return rowView;
    }
}