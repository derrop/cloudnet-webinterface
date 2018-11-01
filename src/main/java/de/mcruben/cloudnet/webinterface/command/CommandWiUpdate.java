package de.mcruben.cloudnet.webinterface.command;

/*
 * Created by Mc_Ruben on 10.08.2018
 * 

 */


import de.dytanic.cloudnet.command.Command;
import de.dytanic.cloudnet.command.CommandSender;
import de.dytanic.cloudnet.lib.MultiValue;
import de.dytanic.cloudnet.lib.utility.Return;
import de.mcruben.cloudnet.webinterface.WebInterface;

public class CommandWiUpdate extends Command {
    public CommandWiUpdate() {
        super("wiupdate", "cloudnet.webinterface.command.update");
    }

    @Override
    public void onExecuteCommand(CommandSender sender, String[] strings) {
        Return<MultiValue<String, String>, Boolean> return_ = WebInterface.getInstance().checkUpdatesSilent();
        if (return_.getSecond()) {
            sender.sendMessage("You are already using the newest version");
        } else {
            WebInterface.getInstance().update(return_);
        }
    }
}
