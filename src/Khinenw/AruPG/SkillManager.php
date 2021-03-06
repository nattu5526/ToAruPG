<?php

namespace Khinenw\AruPG;

use pocketmine\item\Item;

class SkillManager{
    /**
     * @var Skill[]
     */
	private static $skills = [];

	/**
	 * @method boolean registerSkill(Skill $skill) registers an Skill to SkillManager. This must be done when Plugin enabled.
	 * @param Skill $skill The skill to register
	 * @return boolean If the skill registered successfully, it returns true. Otherwise, it returns false.
	 */
	public static function registerSkill(Skill $skill){
		if(!array_key_exists($skill->getId(), self::$skills)){
			self::$skills[$skill->getId()] = $skill;
			$skill->__init();
			return true;
		}
		return false;
	}

	/**
	 * @method boolean forceRegisterSkill(Skill $skill) registers an Skill to SkillManager regardless of whether id of skill is already registered.
	 * @param Skill $skill The skill to register.
	 */
	public static function forceRegisterSkill(Skill $skill){
		self::$skills[$skill->getId()] = $skill;
		$skill->__init();
	}

	/**
	 * @method Skill|null getSkill(int $skillId) gets skill by its id.
	 * @param int $skillId The id of skill which you want to get.
	 * @return Skill|null If the skill is registered, it returns the skill. Otherwise, it returns null
	 */
	public static function getSkill($skillId){
		return isset(self::$skills[$skillId]) ? (clone self::$skills[$skillId]) : null;
	}


	/**
	 * @method Skill[] getSkill(int $skillId) gets skill by its item.
	 * @param Item $item The item of skill which you want to get.
	 * @return Skill[] It returns array of skills.
	 */
	public static function getSkillByItem(Item $item){
        $skills = [];
        foreach(self::$skills as $skill){
            if($skill->getItem() !== null && $skill->getItem()->deepEquals($item, true, false)){
                $skills[] = $skill;
            }
        }
		return $skills;
	}
}