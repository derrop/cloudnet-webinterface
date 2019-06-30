package de.mcruben.cloudnet.webinterface.command;

/*
 * Created by Mc_Ruben on 11.08.2018
 * 

 */


import de.dytanic.cloudnet.command.Command;
import de.dytanic.cloudnet.command.CommandSender;
import de.mcruben.cloudnet.webinterface.setup.WiSetup;

public class CommandWiSetup extends Command {
    public CommandWiSetup() {
        super("wisetup", "cloudnet.webinterface.command.setup");
        description = "starts the setup for the web interface (by Niekold and McRupen)";
    }

    @Override
    public void onExecuteCommand(CommandSender commandSender, String[] strings) {
        new WiSetup();
    }
}
