package de.mcruben.cloudnet.webinterface.command;

/*
 * Created by Mc_Ruben on 29.07.2018
 * 

 */


import de.dytanic.cloudnet.command.Command;
import de.dytanic.cloudnet.command.CommandSender;
import de.mcruben.cloudnet.webinterface.WebInterface;

public class CommandWiVersion extends Command {
    public CommandWiVersion() {
        super("wiversion", "cloudnet.webinterface.command.version");
        description = "prints the version of your web interface (by Niekold and McRupen)";
    }

    @Override
    public void onExecuteCommand(CommandSender sender, String[] strings) {
        WebInterface.getInstance().checkUpdates();
        sender.sendMessage("Your version: " + WebInterface.getInstance().getModuleConfig().getVersion() + " by Niekold and Mc_Ruben");
    }
}
